<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{

    public function __construct()
    {
        // Pastikan package Midtrans sudah diinstall
        if (class_exists('\Midtrans\Config')) {
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized', true);
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds', true);
        }
    }
    
    protected $fillable = [
        'peserta_id',
        'user_id',
        'kursus_id',
        'jadwal_id',
        'jumlah',
        'order_id',
        'snap_token',
        'status_pembayaran',
        'metode_pembayaran',
        'payment_type',
        'transaction_time',
        'transaction_status',
        'fraud_status',
        'settlement_time',
    ];

    protected $casts = [
        'transaction_time' => 'datetime',
        'settlement_time' => 'datetime',
        'jumlah' => 'decimal:2',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    // Relasi dengan kursus
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    // Relasi dengan jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal_Kursus::class, 'jadwal_id');
    }

    // Generate order ID
    public static function generateOrderId()
    {
        return 'CSP-' . date('Ymd') . '-' . strtoupper(uniqid());
    }

    // Scope untuk transaksi pending
    public function scopePending($query)
    {
        return $query->where('status_pembayaran', 'pending');
    }

    // Scope untuk transaksi sukses
    public function scopeSuccess($query)
    {
        return $query->where('status_pembayaran', 'success');
    }

    // Scope untuk transaksi gagal
    public function scopeFailed($query)
    {
        return $query->whereIn('status_pembayaran', ['failed', 'cancelled', 'expired']);
    }

    // Get status badge color
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status_pembayaran) {
            'success' => 'success',
            'pending' => 'warning', 
            'failed' => 'danger',
            'cancelled' => 'secondary',
            'expired' => 'dark',
            default => 'secondary'
        };
    }
}
