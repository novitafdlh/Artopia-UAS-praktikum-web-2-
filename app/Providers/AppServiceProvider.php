<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Art;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate untuk Akses Panel Admin
        Gate::define('access-admin-panel', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk Mengelola User (oleh Admin)
        // Admin bisa menghapus user lain, tetapi tidak bisa menghapus dirinya sendiri.
        Gate::define('manage-users', function (User $loggedInUser, User $targetUser) {
            return $loggedInUser->role === 'admin' && $loggedInUser->id !== $targetUser->id;
        });

        // Gate untuk Mengelola Semua Karya Seni (oleh Admin)
        // Admin memiliki izin untuk mengedit atau menghapus karya seni apapun.
        Gate::define('manage-all-arts', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk Mengelola Karya Seni Milik Sendiri (oleh User)
        // User bisa mengedit atau menghapus karyanya sendiri.
        Gate::define('manage-own-art', function (User $user, Art $art) {
            return $user->id === $art->user_id;
        });

        // Gate untuk User terautentikasi (bisa upload karya, dll.)
        Gate::define('authenticated-user', function (User $user) {
            return $user->role === 'user' || $user->role === 'admin';
        });
    }
}
