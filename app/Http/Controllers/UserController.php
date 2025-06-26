<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Tampilkan form edit profil
    public function editProfile()
    {
        $title = 'Edit Profil';
        $user = Auth::user();
        
        return view('user.edit-profile', compact('title', 'user'));
    }

    // Update profil user
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $updateData = [
                'username' => $request->username,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'asal_sekolah' => $request->asal_sekolah,
                'email' => $request->email,
            ];

            // Handle file upload foto KK
            if ($request->hasFile('foto_kk')) {
                // Hapus foto lama jika ada
                if ($user->foto_kk && Storage::disk('public')->exists($user->foto_kk)) {
                    Storage::disk('public')->delete($user->foto_kk);
                }
                
                // Upload foto baru
                $fotoKkPath = $request->file('foto_kk')->store('foto_kk', 'public');
                $updateData['foto_kk'] = $fotoKkPath;
            }

            $user->update($updateData);

            return redirect()->route('user.edit-profile')->with('success', 'Profil berhasil diperbarui!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
        }
    }

    // Form ganti password
    public function editPassword()
    {
        $title = 'Ganti Password';
        
        return view('user.edit-password', compact('title'));
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        try {
            $user->update([
                'password' => Hash::make($request->password_baru)
            ]);

            return redirect()->route('user.edit-password')->with('success', 'Password berhasil diubah!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengubah password.');
        }
    }

    // Tampilkan profil user (untuk admin lihat detail user)
    public function show($id)
    {
        $user = User::with(['pesertas.kursus', 'pesertas.jadwal'])->findOrFail($id);
        $title = 'Profil User - ' . $user->nama_lengkap;
        
        return view('user.show', compact('user', 'title'));
    }
}
