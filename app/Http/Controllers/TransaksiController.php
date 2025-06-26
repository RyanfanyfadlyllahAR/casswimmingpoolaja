<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Peserta;
use App\Models\Kursus;
use App\Models\Jadwal_Kursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    private $serverKey;
    private $isProduction;
    private $isSanitized;
    private $is3ds;

    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    }

    // Tampilkan daftar transaksi user
    public function index()
    {
        $title = 'Riwayat Transaksi';
        $transaksis = Transaksi::with(['kursus', 'jadwal.instruktur'])
                              ->where('user_id', Auth::id())
                              ->latest()
                              ->get();
        
        return view('transaksi.index', compact('transaksis', 'title'));
    }

    // Proses pembayaran pendaftaran kursus
    public function createPayment(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'jadwal_id' => 'required|exists:jadwal_kursus,id'
        ]);

        try {
            DB::beginTransaction();

            $kursus = Kursus::findOrFail($request->kursus_id);
            $jadwal = Jadwal_Kursus::findOrFail($request->jadwal_id);
            $user = Auth::user();

            // Cek apakah user sudah mendaftar kursus ini
            $existingPeserta = Peserta::where('user_id', $user->id)
                                    ->where('kursus_id', $kursus->id)
                                    ->first();

            if ($existingPeserta) {
                return redirect()->back()->with('error', 'Anda sudah mendaftar di kursus ini.');
            }

            // Cek kapasitas jadwal
            if ($jadwal->kapasitasTersedia() <= 0) {
                return redirect()->back()->with('error', 'Jadwal ini sudah penuh.');
            }

            // Buat data peserta dengan status pending
            $peserta = Peserta::create([
                'user_id' => $user->id,
                'kursus_id' => $kursus->id,
                'jadwal_id' => $jadwal->id,
                'status' => 'nonaktif',
                'status_pembayaran' => 'pending',
                'tanggal_daftar' => now()->format('Y-m-d'),
            ]);

            // Generate order ID
            $orderId = Transaksi::generateOrderId();

            // Buat data transaksi
            $transaksi = Transaksi::create([
                'peserta_id' => $peserta->id,
                'user_id' => $user->id,
                'kursus_id' => $kursus->id,
                'jadwal_id' => $jadwal->id,
                'jumlah' => $kursus->biaya,
                'status_pembayaran' => 'pending',
                'metode_pembayaran' => 'midtrans',
                'order_id' => $orderId,
            ]);

            // Prepare parameter untuk Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $kursus->biaya,
                ],
                'customer_details' => [
                    'first_name' => $user->nama_lengkap,
                    'email' => $user->email,
                    'phone' => $user->no_telp ?? '',
                ],
                'item_details' => [
                    [
                        'id' => $kursus->id,
                        'price' => (int) $kursus->biaya,
                        'quantity' => 1,
                        'name' => $kursus->nama_kursus,
                        'brand' => 'CAS Swimming Pool',
                        'category' => 'Kursus Renang',
                    ]
                ],
                'callbacks' => [
                    'finish' => route('transaksi.finish'),
                    'unfinish' => route('transaksi.unfinish'),
                    'error' => route('transaksi.error'),
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            // Update snap token
            $transaksi->update(['snap_token' => $snapToken]);

            DB::commit();

            return view('transaksi.payment', compact('transaksi', 'snapToken', 'kursus', 'jadwal', 'user'));

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat pembayaran. Silakan coba lagi.');
        }
    }

    // Callback dari Midtrans - PERBAIKAN
    public function callback(Request $request)
    {
        // Log incoming callback untuk debugging
        Log::info('Midtrans callback received', $request->all());

        $serverKey = config('midtrans.server_key');
        
        // Validasi signature key
        $orderId = $request->order_id;
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $signatureKey = $request->signature_key;

        $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        
        // Verifikasi signature
        if ($mySignatureKey !== $signatureKey) {
            Log::error('Invalid signature key', [
                'received' => $signatureKey,
                'expected' => $mySignatureKey
            ]);
            return response('Invalid signature', 403);
        }

        // Cari transaksi berdasarkan order_id
        $transaksi = Transaksi::where('order_id', $orderId)->first();
        
        if (!$transaksi) {
            Log::error('Transaksi not found for order_id: ' . $orderId);
            return response('Transaction not found', 404);
        }

        DB::beginTransaction();
        try {
            $transactionStatus = $request->transaction_status;
            $fraudStatus = $request->fraud_status ?? null;
            $paymentType = $request->payment_type ?? null;

            // Log status update
            Log::info('Updating transaction status', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus
            ]);

            // Update status transaksi
            $updateData = [
                'status_pembayaran' => $transactionStatus,
                'payment_type' => $paymentType,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'transaction_time' => $request->transaction_time ?? now(),
            ];

            // Tambahkan settlement_time jika ada
            if ($request->settlement_time) {
                $updateData['settlement_time'] = $request->settlement_time;
            }

            $transaksi->update($updateData);

            // Update status peserta berdasarkan status pembayaran
            $peserta = $transaksi->peserta;
            
            if ($peserta) {
                if (in_array($transactionStatus, ['capture', 'settlement'])) {
                    // Pembayaran berhasil
                    $peserta->update([
                        'status' => 'aktif',
                        'status_pembayaran' => 'lunas'
                    ]);
                    Log::info('Peserta status updated to aktif for order: ' . $orderId);
                    
                } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expired', 'failure'])) {
                    // Pembayaran gagal/dibatalkan
                    $peserta->update([
                        'status' => 'batal',
                        'status_pembayaran' => 'failed'
                    ]);
                    Log::info('Peserta status updated to batal for order: ' . $orderId);
                    
                } elseif ($transactionStatus === 'pending') {
                    // Pembayaran pending
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'pending'
                    ]);
                    Log::info('Peserta status updated to pending for order: ' . $orderId);
                }
            } else {
                Log::error('Peserta not found for transaction: ' . $orderId);
            }

            DB::commit();
            Log::info('Payment callback processed successfully for order: ' . $orderId);
            
            return response('OK', 200);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Callback processing error: ' . $e->getMessage(), [
                'order_id' => $orderId,
                'exception' => $e->getTraceAsString()
            ]);
            return response('Error processing callback', 500);
        }
    }

    // Halaman setelah pembayaran selesai
    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $transaksi = null;
        
        if ($orderId) {
            $transaksi = Transaksi::where('order_id', $orderId)
                                 ->where('user_id', Auth::id())
                                 ->with(['kursus', 'jadwal.instruktur'])
                                 ->first();
                                 
            // Update status dari Midtrans untuk memastikan data terbaru
            if ($transaksi) {
                $this->updateTransactionStatus($transaksi);
            }
        }

        $title = 'Pembayaran Selesai';
        return view('transaksi.finish', compact('transaksi', 'title'));
    }

    // Halaman pembayaran tidak selesai
    public function unfinish(Request $request)
    {
        $orderId = $request->order_id;
        
        // Update status jika ada order_id
        if ($orderId && Auth::check()) {
            $transaksi = Transaksi::where('order_id', $orderId)
                                 ->where('user_id', Auth::id())
                                 ->first();
            if ($transaksi) {
                $this->updateTransactionStatus($transaksi);
            }
        }
        
        $title = 'Pembayaran Belum Selesai';
        return view('transaksi.unfinish', compact('title'));
    }

    // Halaman error pembayaran
    public function error(Request $request)
    {
        $orderId = $request->order_id;
        
        // Update status jika ada order_id
        if ($orderId && Auth::check()) {
            $transaksi = Transaksi::where('order_id', $orderId)
                                 ->where('user_id', Auth::id())
                                 ->first();
            if ($transaksi) {
                $this->updateTransactionStatus($transaksi);
            }
        }
        
        $title = 'Error Pembayaran';
        return view('transaksi.error', compact('title'));
    }

    // Detail transaksi
    public function show(Transaksi $transaksi)
    {
        // Pastikan user hanya bisa melihat transaksi miliknya
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        $title = 'Detail Transaksi';
        return view('transaksi.show', compact('transaksi', 'title'));
    }

    // Cek status pembayaran - PERBAIKAN
    public function checkStatus(Transaksi $transaksi)
    {
        // Pastikan user hanya bisa cek transaksi miliknya
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            $this->updateTransactionStatus($transaksi);
            return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
            
        } catch (\Exception $e) {
            Log::error('Check status error: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Method helper untuk update status transaksi dari Midtrans - BARU
    private function updateTransactionStatus(Transaksi $transaksi)
    {
        try {
            $status = \Midtrans\Transaction::status($transaksi->order_id);
            
            DB::beginTransaction();
            
            // Update status transaksi
            $transaksi->update([
                'status_pembayaran' => 'success',
                'transaction_status' => $status->transaction_status,
                'fraud_status' => $status->fraud_status ?? null,
                'payment_type' => $status->payment_type ?? null,
                'transaction_time' => $status->transaction_time ?? null,
                'settlement_time' => $status->settlement_time ?? null,
            ]);

            // Update status peserta
            $peserta = $transaksi->peserta;
            if ($peserta) {
                if (in_array($status->transaction_status, ['capture', 'success'])) {
                    $peserta->update([
                        'status' => 'aktif',
                        'status_pembayaran' => 'lunas'
                    ]);
                } elseif (in_array($status->transaction_status, ['cancel', 'deny', 'expired', 'failure'])) {
                    $peserta->update([
                        'status' => 'batal',
                        'status_pembayaran' => 'failed'
                    ]);
                } elseif ($status->transaction_status === 'pending') {
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'pending'
                    ]);
                }
            }

            DB::commit();
            
            Log::info('Transaction status updated successfully', [
                'order_id' => $transaksi->order_id,
                'status' => $status->transaction_status
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Update transaction status error: ' . $e->getMessage());
            throw $e;
        }
    }

    // ========== ADMIN METHODS ==========

    // Admin: Daftar semua transaksi
    public function adminIndex()
    {
        $title = 'Kelola Transaksi';
        $transaksis = Transaksi::with(['user', 'kursus', 'jadwal.instruktur'])
                              ->latest()
                              ->get();
        
        return view('admin.transaksi.index', compact('transaksis', 'title'));
    }

    // Admin: Detail transaksi
    public function adminShow(Transaksi $transaksi)
    {
        $title = 'Detail Transaksi - ' . $transaksi->order_id;
        return view('admin.transaksi.show', compact('transaksi', 'title'));
    }

    // Admin: Update status pembayaran manual
    public function adminUpdateStatus(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,settlement,expire,failed',
            'catatan' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            // Update status transaksi
            $transaksi->update([
                'status_pembayaran' => $request->status_pembayaran,
                'transaction_status' => $request->status_pembayaran,
                'catatan_admin' => $request->catatan,
                'updated_by_admin' => Auth::id(),
                'updated_at' => now()
            ]);

            // Update status peserta berdasarkan status pembayaran
            $peserta = $transaksi->peserta;
            if ($peserta) {
                if (in_array($request->status_pembayaran, ['capture', 'settlement'])) {
                    $peserta->update([
                        'status' => 'aktif',
                        'status_pembayaran' => 'lunas'
                    ]);
                } elseif (in_array($request->status_pembayaran, ['cancel', 'expired', 'failed'])) {
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'batal'
                    ]);
                } elseif ($request->status_pembayaran === 'pending') {
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'pending'
                    ]);
                }
            }

            DB::commit();
            
            Log::info('Admin updated transaction status', [
                'order_id' => $transaksi->order_id,
                'status' => $request->status_pembayaran,
                'admin_id' => Auth::id()
            ]);

            return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Admin update status error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui status pembayaran.');
        }
    }

    // Admin: Sync status dengan Midtrans
    public function adminSyncStatus(Transaksi $transaksi)
    {
        try {
            $this->updateTransactionStatus($transaksi);
            //update status peserta
            $peserta = $transaksi->peserta;
            if ($peserta) {
                if (in_array($transaksi->status_pembayaran, ['capture', 'success'])) {
                    $peserta->update([
                        'status' => 'aktif',
                        'status_pembayaran' => 'lunas'
                    ]);
                } elseif (in_array($transaksi->status_pembayaran, ['cancel', 'expired', 'failed'])) {
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'batal'
                    ]);
                } elseif ($transaksi->status_pembayaran === 'pending') {
                    $peserta->update([
                        'status' => 'nonaktif',
                        'status_pembayaran' => 'pending'
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Status berhasil disinkronkan dengan Midtrans.');
            
        } catch (\Exception $e) {
            Log::error('Admin sync status error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal sinkronisasi dengan Midtrans: ' . $e->getMessage());
        }
    }
}
