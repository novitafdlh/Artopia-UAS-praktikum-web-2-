@extends('components.user_layout')

@section('title', 'Dashboard User')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight"> {{-- Warna teks header --}}
        {{ __('Dashboard Pribadi Anda') }}
    </h2>
@endsection

@section('content')
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Pesan sukses dari session --}}
            @if (session('success'))
                <div class="bg-[#DAF1DE] border border-[#235347] text-[#0B2B26] px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-[#235347]" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.15a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.03a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.15 2.758 3.15a1.2 1.2 0 0 1 0 1.697z"/>
                        </svg>
                    </span>
                </div>
            @endif
            {{-- Pesan error dari session --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6 shadow-md" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.15a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.03a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.15 2.758 3.15a1.2 1.2 0 0 1 0 1.697z"/>
                        </svg>
                    </span>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 lg:p-8"> {{-- Kartu utama --}}
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-[#051F20] mb-4">Selamat datang, {{ Auth::user()->name }} di Artopia!</h3>
                    <p class="mb-6 text-base text-gray-700">Jelajahi dunia seni digital Anda. Di sini Anda bisa mengelola profil dan karya seni Anda.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative bg-gradient-to-br from-[#163832] to-[#0B2B26] p-8 rounded-lg shadow-lg text-white transform hover:scale-[1.02] transition duration-300 ease-in-out cursor-pointer overflow-hidden">
                            {{-- Elemen artistik latar belakang --}}
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#235347] rounded-full blur-xl opacity-20"></div>
                            <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-[#DAF1DE] rounded-full blur-xl opacity-20"></div>

                            <h4 class="text-xl font-semibold mb-3">Profil Saya</h4>
                            <p class="text-[#DAF1DE] mb-4 text-sm">Lihat dan perbarui informasi akun Anda.</p>
                            <a href="{{ route('user.profile.index') }}" class="inline-flex items-center px-4 py-2 bg-[#DAF1DE] border border-transparent rounded-md font-semibold text-xs text-[#0B2B26] uppercase tracking-wider hover:bg-[#8E8B9B] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#DAF1DE] focus:ring-offset-2 transition ease-in-out duration-150">
                                Kelola Profil <i class="ml-2 fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="relative bg-gradient-to-br from-[#235347] to-[#163832] p-8 rounded-lg shadow-lg text-white transform hover:scale-[1.02] transition duration-300 ease-in-out cursor-pointer overflow-hidden">
                            {{-- Elemen artistik latar belakang --}}
                            <div class="absolute -top-4 -left-4 w-24 h-24 bg-[#8E8B9B] rounded-full blur-xl opacity-20"></div>
                            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-[#DAF1DE] rounded-full blur-xl opacity-20"></div>

                            <h4 class="text-xl font-semibold mb-3">Karya Seni Saya</h4>
                            <p class="text-[#DAF1DE] mb-4 text-sm">Lihat, unggah, edit, dan hapus karya seni yang Anda bagikan.</p>
                            <a href="{{ route('user.artwork.index') }}" class="inline-flex items-center px-4 py-2 bg-[#DAF1DE] border border-transparent rounded-md font-semibold text-xs text-[#0B2B26] uppercase tracking-wider hover:bg-[#8E8B9B] hover:text-white focus:outline-none focus:ring-2 focus:ring-[#DAF1DE] focus:ring-offset-2 transition ease-in-out duration-150">
                                Kelola Karya Seni <i class="ml-2 fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Bagian tambahan untuk inspirasi Artopia (opsional) --}}
                    <div class="mt-8 text-center text-gray-600">
                        <p class="text-lg mb-2">"Setiap goresan adalah sebuah penemuan, setiap piksel adalah alam semesta."</p>
                        <p class="text-sm font-light">- Seniman Artopia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection