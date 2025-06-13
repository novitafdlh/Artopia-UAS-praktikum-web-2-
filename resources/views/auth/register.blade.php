@extends('components.auth-layout')

@section('title', 'Daftar Akun') {{-- Judul halaman untuk tag <title> --}}
@section('section_title', 'Daftar Akun Baru') {{-- Judul di dalam kartu form --}}
@section('section_description', 'Daftar menggunakan email Anda untuk memulai.') {{-- Deskripsi di dalam kartu form --}}

@section('form_content') {{-- Nama section harus sesuai dengan @yield di auth-layout.blade.php --}}

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-[#DAF1DE] border border-[#235347] text-[#0B2B26] px-4 py-3 rounded-lg relative mb-4 shadow-md" role="alert">
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
    @endif

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

    <form action="{{ route('auth.register') }}" method="POST" class="flex flex-col gap-6">
        @csrf

        <div class="flex flex-col gap-2">
            <label for="name" class="font-semibold text-zinc-700 text-sm tracking-wide">Nama Lengkap</label>
            <input type="text" id="name" name="name"
                class="px-4 py-2.5 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm
                       focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                       transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                       @error('name') border-red-500 ring-red-300 @enderror"
                placeholder="Nama Lengkap Anda" value="{{ old('name') }}" required autofocus>
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="email" class="font-semibold text-zinc-700 text-sm tracking-wide">Alamat Email</label>
            <input type="email" id="email" name="email"
                class="px-4 py-2.5 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm
                       focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                       transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                       @error('email') border-red-500 ring-red-300 @enderror"
                placeholder="Alamat Email Anda" value="{{ old('email') }}" required>
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="password" class="font-semibold text-zinc-700 text-sm tracking-wide">Password</label>
            <input type="password" id="password" name="password"
                class="px-4 py-2.5 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm
                       focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                       transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                       @error('password') border-red-500 ring-red-300 @enderror"
                placeholder="Kata Sandi Anda" required autocomplete="new-password">
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="password_confirmation" class="font-semibold text-zinc-700 text-sm tracking-wide">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="px-4 py-2.5 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm
                       focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347]
                       transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500
                       @error('password_confirmation') border-red-500 ring-red-300 @enderror"
                placeholder="Konfirmasi Kata Sandi Anda" required autocomplete="new-password">
            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-gradient-to-r from-[#163832] to-[#235347] hover:from-[#0B2B26] hover:to-[#163832]
                   text-white font-bold text-lg px-6 py-3 rounded-lg shadow-lg
                   focus:outline-none focus:ring-4 focus:ring-[#8E8B9B] focus:ring-opacity-75
                   transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer mt-4">
            <span>Daftar Akun Baru</span>
        </button>

        <p class="text-zinc-600 text-sm text-center mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-[#235347] font-semibold underline hover:text-[#163832] transition duration-200 ease-in-out">Login Di Sini!</a>
        </p>
    </form>
@endsection