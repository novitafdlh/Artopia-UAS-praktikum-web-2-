<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Controller untuk autentikasi

// Controllers untuk area User/Public
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\ArtworkController as UserArtworkController;

// Controllers untuk area Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- Public / General Routes ---
// Halaman utama akan menjadi galeri. Hapus Route::get('/', function () { return view('welcome'); });
Route::get('/', [AuthController::class, 'login'])->name('login');

// Galeri 
Route::get('/gallery', [GalleryController::class, 'index'])->name('user.gallery.index');
Route::get('/gallery/{art}', [GalleryController::class, 'show'])->name('user.gallery.show');


// --- Authentication Routes (Menggunakan AuthController tunggal) ---
// Grup route untuk login, register, dan authenticate.
Route::group(['as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

// Route Logout (di luar grup auth. karena akan diakses setelah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- Authenticated User Routes ---
// Semua route di sini membutuhkan user yang sudah login.
// Prefix 'user.' akan ditambahkan ke nama route (misal: user.dashboard, user.profile.index)
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
// Hanya user yang terautentikasi dan memiliki izin 'access-admin-panel' yang bisa mengakses.
// Prefix 'admin/' pada URL dan 'admin.' pada nama route.
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin User Management (menggunakan 'user' sebagai resource name)
    // Sesuai dengan folder admin/user dan UserController
    Route::resource('user', AdminUserController::class)->except(['show']);

    // Admin Artwork Management (menggunakan 'artwork' sebagai resource name)
    // Sesuai dengan folder admin/artwork dan ArtworkController
    Route::resource('arts', \App\Http\Controllers\Admin\ArtworkController::class);
});