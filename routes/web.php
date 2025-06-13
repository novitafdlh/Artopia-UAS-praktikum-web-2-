<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 

// Controllers untuk User
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\ArtworkController as UserArtworkController;

// Controllers untuk Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;

// --- Public / General Routes ---
Route::get('/', [AuthController::class, 'login'])->name('login');

// Galeri 
Route::get('/gallery', [GalleryController::class, 'index'])->name('user.gallery.index');
Route::get('/gallery/{art}', [GalleryController::class, 'show'])->name('user.gallery.show');

// login, register, dan authenticate.
Route::group(['as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->name('user.')->group(function () {
    // User Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Profile Management (dari User\ProfileController)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index'); // Menampilkan profil & daftar karya
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Form edit profil
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update'); // Proses update profil
        Route::get('/password/edit', [ProfileController::class, 'editPassword'])->name('profile.edit_password'); // Form ubah password
        Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('profile.update_password'); // Proses ubah password
        Route::delete('/delete-account', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Hapus akun
    });

    // User Artwork Management (dari User\ArtworkController)
    Route::prefix('my-arts')->group(function () {
        Route::get('/', [UserArtworkController::class, 'index'])->name('artwork.index'); // Atau my_arts.index jika suka
        Route::get('/create', [UserArtworkController::class, 'create'])->name('artwork.create');
        Route::post('/', [UserArtworkController::class, 'store'])->name('artwork.store');
        Route::get('/{art}/edit', [UserArtworkController::class, 'edit'])->name('artwork.edit');
        Route::put('/{art}', [UserArtworkController::class, 'update'])->name('artwork.update');
        Route::delete('/{art}', [UserArtworkController::class, 'destroy'])->name('artwork.destroy');
    });
});


// --- Admin Routes ---
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin User Management
    Route::resource('user', AdminUserController::class)->except(['show']);

    // Admin Artwork Management
    Route::resource('arts', \App\Http\Controllers\Admin\ArtworkController::class);
});