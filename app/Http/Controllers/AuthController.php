<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('login.index', ['title' => 'Login']);
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Redirect based on user role
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan halaman register
    public function showRegisterForm()
    {
        return view('daftar.index', ['title' => 'Daftar']);
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'upload' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'asal' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Handle file upload
        $fotoKkPath = null;
        if ($request->hasFile('upload')) {
            $fotoKkPath = $request->file('upload')->store('kartu-keluarga', 'public');
        }

        $user = User::create([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'alamat' => $validated['alamat'],
            'foto_kk' => $fotoKkPath,
            'asal_sekolah' => $validated['asal'],
            'no_telp' => $validated['no_telepon'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil logout.');
    }

    // Dashboard user
    public function dashboard()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'user' => Auth::user()
        ]);
    }

    // Dashboard admin
    public function adminDashboard()
    {
        $totalUsers = User::where('is_admin', false)->count();
        
        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'totalUsers' => $totalUsers
        ]);
    }
}
