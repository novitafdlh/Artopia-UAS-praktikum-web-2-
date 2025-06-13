<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate; // Tetap ada karena Gate diperlukan untuk otorisasi akun

class ProfileController extends Controller
{
    /**
     * Tampilkan profil pengguna (dan daftar karya seni).
     *
     * CATATAN: Karena kita memisahkan, metode index ini akan hanya menampilkan profil,
     * bukan daftar karya seni. Daftar karya seni akan di handle oleh User\ArtworkController.
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        // $arts = $user->arts()->latest()->paginate(10); // Hapus baris ini

        return view('user.profile.index', compact('user')); // Kirim hanya user ke view
    }

    /**
     * Tampilkan form untuk mengedit profil pengguna.
     */
    public function edit(): \Illuminate\View\View
    {
        return view('user.profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update informasi profil pengguna.
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->fill($validator->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('user.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Tampilkan form untuk mengubah password.
     */
    public function editPassword(): \Illuminate\View\View
    {
        return view('user.profile.change_password');
    }

    /**
     * Update password pengguna.
     */
    public function updatePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8', 'string', 'different:current_password'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);

        return Redirect::route('user.profile.index')->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password_confirmation' => ['required', 'string', 'current_password'],
        ], [
            'password_confirmation.current_password' => 'Password yang Anda masukkan salah.',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        Auth::logout();

        // Hapus semua karya seni user ini beserta gambarnya
        // Pindahkan logika ini ke tempat yang lebih sesuai jika Anda punya 'deleter' untuk user
        // Atau biarkan di sini karena ini adalah penghapusan akun.
        foreach ($user->arts as $art) {
            if ($art->image_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($art->image_path);
            }
            $art->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Akun Anda berhasil dihapus.');
    }
}