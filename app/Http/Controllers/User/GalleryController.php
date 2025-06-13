<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    public function index()
    {
        $arts = Art::with('user')->latest()->paginate(12);
        return view('user.gallery.index', compact('arts'));
    }

    public function show(Art $art)
    {
        return view('user.gallery.show', compact('art'));
    }
}