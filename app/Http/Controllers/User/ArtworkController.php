<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate; // Penting: Import Gate

class ArtworkController extends Controller
{
    /**
     * Tampilkan semua karya seni milik user yang sedang login.
     */
    public function index(): \Illuminate\View\View
    {
        $arts = Auth::user()->arts()->latest()->paginate(10);
        return view('user.artwork.index', compact('arts')); // View baru: user.artwork.index
    }

    /**
     * Tampilkan form untuk mengunggah karya seni baru.
     */
    public function create(): \Illuminate\View\View
    {
        Gate::authorize('authenticated-user'); // Pastikan user terautentikasi bisa upload
        return view('user.artwork.create'); // View baru: user.artwork.create
    }

    /**
     * Simpan karya seni yang baru diunggah.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('authenticated-user');
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imagePath = $request->file('image')->store('art_images', 'public');

        Auth::user()->arts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil diunggah!'); // Redirect ke rute baru
    }

    /**
     * Tampilkan form untuk mengedit karya seni tertentu (milik user).
     */
    public function edit(Art $art): \Illuminate\View\View
    {
        Gate::authorize('manage-own-art', $art); // Pastikan user adalah pemiliknya
        return view('user.artwork.edit', compact('art')); // View baru: user.artwork.edit
    }

    /**
     * Update karya seni tertentu (milik user).
     */
    public function update(Request $request, Art $art): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('manage-own-art', $art);
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $art->fill($validator->validated());

        if ($request->hasFile('image')) {
            if ($art->image_path) {
                Storage::disk('public')->delete($art->image_path);
            }
            $imagePath = $request->file('image')->store('art_images', 'public');
            $art->image_path = $imagePath;
        }

        $art->save();

        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil diperbarui!'); // Redirect ke rute baru
    }

    /**
     * Hapus karya seni tertentu (milik user).
     */
    public function destroy(Art $art): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('manage-own-art', $art);
        if ($art->image_path) {
            Storage::disk('public')->delete($art->image_path);
        }
        $art->delete();
        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil dihapus!'); // Redirect ke rute baru
    }
}