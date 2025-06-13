<?php

namespace App\Http\Controllers; // Pastikan namespace ini ada di root Controllers

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Penting: Tambahkan ini untuk hashing password
use Illuminate\Validation\ValidationException; // Penting: Tambahkan ini untuk error autentikasi

class AuthController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Tampilkan form login.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Simpan user baru setelah registrasi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Gunakan 'confirmed' untuk 'password_confirmation'
            // 'confirm_password' => 'required|same:password', // Ini tidak lagi diperlukan jika menggunakan 'confirmed' pada 'password'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Penting: Hash password sebelum menyimpannya ke database
            'password' => Hash::make($validated['password']),
            'role' => 'user', // Atur role default menjadi 'user'
        ]);

        // Login user secara otomatis setelah registrasi berhasil
        Auth::attempt($request->only('email', 'password'));
        $request->session()->regenerate();

        // Redirect ke dashboard user setelah register dan login
        return redirect()->intended(route('auth.login'))->with('success', 'Registrasi berhasil! Silahkan login kembali.');
    }

    /**
     * Authentikasi pengguna.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Opsional: Handle "Remember Me"
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect user berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Anda telah berhasil masuk sebagai Admin.');
            }
            return redirect()->intended(route('user.dashboard'))->with('success', 'Anda telah berhasil masuk.');
        }

        // Jika autentikasi gagal
        // Gunakan ValidationException::withMessages untuk pesan error yang lebih standar Laravel
        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Anda telah berhasil keluar.'); // Redirect ke halaman utama galeri
    }
}