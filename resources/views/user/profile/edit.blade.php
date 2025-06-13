@extends('components.user_layout')

@section('title', 'Edit Profil')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight"> {{-- Warna teks header --}}
        {{ __('Edit Profil Anda') }}
    </h2>
@endsection

@section('content')
    <div class="py-8 sm:py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
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
            {{-- Pesan error dari session (jika ada) --}}
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
                    <h3 class="text-2xl font-bold text-[#051F20] mb-4">Informasi Profil Anda</h3>
                    <p class="mt-1 text-base text-gray-700 mb-6">Perbarui informasi profil dan alamat email akun Anda.</p>

                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4"> {{-- Margin bottom --}}
                            <label for="name" class="block font-semibold text-sm text-zinc-700 mb-1">Nama</label> {{-- Label style --}}
                            <input id="name" name="name" type="text" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6"> {{-- Margin bottom --}}
                            <label for="email" class="block font-semibold text-sm text-zinc-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#163832] to-[#235347] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#0B2B26] hover:to-[#163832] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection