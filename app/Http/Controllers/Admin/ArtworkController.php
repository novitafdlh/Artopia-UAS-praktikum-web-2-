<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Art;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class ArtworkController extends Controller
{
    public function index()
    {
        $arts = Art::with('user')->latest()->paginate(10);
        return view('admin.arts.index', compact('arts'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.arts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('art_images', 'public');

        Art::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.arts.index')->with('success', 'Karya seni berhasil ditambahkan!');
    }

    public function edit(Art $art)
    {
        Gate::authorize('manage-all-arts');
        $users = User::all();
        return view('admin.arts.edit', compact('art', 'users'));
    }

    public function update(Request $request, Art $art)
    {
        Gate::authorize('manage-all-arts');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $art->user_id = $request->user_id;
        $art->title = $request->title;
        $art->description = $request->description;

        if ($request->hasFile('image')) {
            if ($art->image_path) {
                Storage::disk('public')->delete($art->image_path);
            }
            $imagePath = $request->file('image')->store('art_images', 'public');
            $art->image_path = $imagePath;
        }

        $art->save();

        return redirect()->route('admin.arts.index')->with('success', 'Karya seni berhasil diperbarui!');
    }

    public function destroy(Art $art)
    {
        Gate::authorize('manage-all-arts');
        if ($art->image_path) {
            Storage::disk('public')->delete($art->image_path);
        }
        $art->delete();
        return back()->with('success', 'Karya seni berhasil dihapus!');
    }
}