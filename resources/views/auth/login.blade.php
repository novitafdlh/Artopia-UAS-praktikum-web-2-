@extends('components.auth-layout')

@section('title', 'Login Akun')
@section('section_title', 'Masuk ke Akun Anda')
@section('section_description', 'Silakan masukkan email dan password untuk login.')

@section('form_content')

    {{-- Pesan error validasi umum --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-md" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}" class="flex flex-col gap-6">
        @csrf

        <div>
            <label for="email" class="block font-semibold text-zinc-700 text-sm tracking-wide mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm {{-- Ubah py-2.5 menjadi py-3 --}}
                          focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                          transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                          @error('email') border-red-500 ring-red-300 @enderror">
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-semibold text-zinc-700 text-sm tracking-wide mb-1">Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm {{-- Ubah py-2.5 menjadi py-3 --}}
                          focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                          transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                          @error('password') border-red-500 ring-red-300 @enderror">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-gradient-to-r from-[#163832] to-[#235347] hover:from-[#0B2B26] hover:to-[#163832]
                   text-white font-bold text-lg px-6 py-3 rounded-lg shadow-lg
                   focus:outline-none focus:ring-4 focus:ring-[#8E8B9B] focus:ring-opacity-75
                   transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer mt-4">
            <span>Login</span>
        </button>

        <p class="text-zinc-600 text-sm text-center mt-6">
            Belum punya akun?
            <a href="{{ route('auth.register') }}" class="text-[#235347] font-semibold underline hover:text-[#163832] transition duration-200 ease-in-out">Daftar Akun Baru</a>
        </p>
    </form>
@endsection