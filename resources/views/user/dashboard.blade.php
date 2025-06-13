@extends('components.user_layout')

@section('title', 'Dashboard User')

@section('header')
    <div class="flex items-center gap-3">
        <svg class="w-8 h-8 text-[#235347]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"> {{-- Icon header --}}
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        <h2 class="font-bold text-2xl text-[#051F20] leading-tight"> {{-- Warna teks judul header --}}
            {{ __('Dashboard Pribadi Anda') }}
        </h2>
    </div>
@endsection

@section('content')
    <div class="py-10 min-h-[80vh] bg-gradient-to-br from-[#DAF1DE] via-[#8E8B9B] to-[#DAF1DE]"> {{-- Background Artopia --}}
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Pesan sukses dari session --}}
            @if (session('success'))
                <div class="bg-[#DAF1DE] border border-[#235347] text-[#0B2B26] px-4 py-3 rounded-lg relative mb-6 shadow-md flex items-center gap-2" role="alert">
                    <svg class="w-5 h-5 text-[#235347]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                    <button type="button" class="absolute top-2 right-2 text-[#235347] hover:text-[#163832]" onclick="this.parentElement.style.display='none';">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
            {{-- Pesan error dari session --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg relative mb-6 shadow-md flex items-center gap-2" role="alert">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                    <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700" onclick="this.parentElement.style.display='none';">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white/90 rounded-3xl shadow-2xl overflow-hidden p-8 lg:p-12 backdrop-blur-md border border-[#DAF1DE]"> {{-- Background putih transparan --}}
                <div class="text-gray-900">
                    <h3 class="text-3xl font-extrabold text-[#051F20] mb-3">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mb-8 text-base text-gray-700">Jelajahi dunia seni digital Anda. Di sini Anda bisa mengelola profil dan karya seni Anda.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="relative group bg-gradient-to-br from-[#163832] to-[#0B2B26] p-8 rounded-2xl shadow-xl text-white hover:shadow-2xl transition-all duration-300 overflow-hidden cursor-pointer">
                            {{-- Elemen artistik latar belakang --}}
                            <div class="absolute -top-8 -right-8 w-32 h-32 bg-[#235347] rounded-full blur-2xl opacity-30"></div>
                            <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-[#DAF1DE] rounded-full blur-2xl opacity-20"></div>
                            <div class="flex items-center gap-3 mb-4">
                                <svg class="w-8 h-8 text-[#DAF1DE]/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <h4 class="text-xl font-semibold">Profil Saya</h4>
                            </div>
                            <p class="text-[#DAF1DE] mb-6 text-sm">Lihat dan perbarui informasi akun Anda.</p>
                            <a href="{{ route('user.profile.edit') }}" class="inline-flex items-center px-5 py-2 bg-[#DAF1DE] border border-transparent rounded-full font-semibold text-sm text-[#0B2B26] uppercase tracking-wider shadow hover:bg-[#8E8B9B] hover:text-white transition">
                                Kelola Profil
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                        <div class="relative group bg-gradient-to-br from-[#235347] to-[#163832] p-8 rounded-2xl shadow-xl text-white hover:shadow-2xl transition-all duration-300 overflow-hidden cursor-pointer">
                            {{-- Elemen artistik latar belakang --}}
                            <div class="absolute -top-8 -left-8 w-32 h-32 bg-[#8E8B9B] rounded-full blur-2xl opacity-30"></div>
                            <div class="absolute -bottom-8 -right-8 w-24 h-24 bg-[#DAF1DE] rounded-full blur-2xl opacity-20"></div>
                            <div class="flex items-center gap-3 mb-4">
                                <svg class="w-8 h-8 text-[#DAF1DE]/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4M4 11h16"/>
                                </svg>
                                <h4 class="text-xl font-semibold">Karya Seni Saya</h4>
                            </div>
                            <p class="text-[#DAF1DE] mb-6 text-sm">Lihat, unggah, edit, dan hapus karya seni yang Anda bagikan.</p>
                            <a href="{{ route('user.artwork.index') }}" class="inline-flex items-center px-5 py-2 bg-[#DAF1DE] border border-transparent rounded-full font-semibold text-sm text-[#0B2B26] uppercase tracking-wider shadow hover:bg-[#8E8B9B] hover:text-white transition">
                                Kelola Karya Seni
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Bagian tambahan untuk inspirasi Artopia --}}
                    <div class="mt-12 text-center text-gray-600">
                        <p class="text-lg italic mb-2">"Setiap goresan adalah sebuah penemuan, setiap piksel adalah alam semesta."</p>
                        <p class="text-sm font-light">- Seniman Artopia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection