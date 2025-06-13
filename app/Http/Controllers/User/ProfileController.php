<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Art;

class ProfileController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }

    public function edit(): \Illuminate\View\View
    {
        $user = Auth::user();

        return view('user.profile.edit', compact('user'));
    }

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

    public function updatePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return Redirect::route('user.profile.index')->with('success', 'Password berhasil diperbarui.');
    }

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

        foreach ($user->arts as $art) {
            if ($art->image_path) {
                Storage::disk('public')->delete($art->image_path);
            }
            $art->delete();
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Akun Anda berhasil dihapus.');
    }
}
