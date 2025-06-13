<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class ArtworkController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $arts = Auth::user()->arts()->latest()->paginate(10);
        return view('user.artwork.index', compact('arts'));
    }

    public function create(): \Illuminate\View\View
    {
        Gate::authorize('authenticated-user');
        return view('user.artwork.create');
    }

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

        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil diunggah!');
    }

    public function edit(Art $art): \Illuminate\View\View
    {
        Gate::authorize('manage-own-art', $art);
        return view('user.artwork.edit', compact('art'));
    }

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

        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil diperbarui!');
    }

    public function destroy(Art $art): \Illuminate\Http\RedirectResponse
    {
        Gate::authorize('manage-own-art', $art);
        if ($art->image_path) {
            Storage::disk('public')->delete($art->image_path);
        }
        $art->delete();
        return Redirect::route('user.artwork.index')->with('success', 'Karya seni berhasil dihapus!');
    }
}