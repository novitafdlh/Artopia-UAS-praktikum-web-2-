@extends('components.user_layout')

@section('title', 'Profil Saya')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight">
        {{ __('Profil Saya') }}
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
                    {{-- Bagian Informasi Profil --}}
                    <h3 class="text-2xl font-bold text-[#051F20] mb-4">Informasi Profil</h3>
                    <p class="mb-2 text-gray-700"><span class="font-semibold">Nama:</span> {{ $user->name }}</p>
                    <p class="mb-4 text-gray-700"><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('user.profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#235347] to-[#163832] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#163832] hover:to-[#0B2B26] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Profil <i class="ml-2 fas fa-edit"></i>
                        </a>
                        <a href="{{ route('user.profile.edit_password') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#8E8B9B] to-[#235347] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#235347] hover:to-[#163832] focus:outline-none focus:ring-2 focus:ring-[#DAF1DE] focus:ring-offset-2 transition ease-in-out duration-150">
                            Ubah Password <i class="ml-2 fas fa-key"></i>
                        </a>
                    </div>
                    
                    {{-- Bagian Hapus Akun --}}
                    <div class="mt-8 pt-8 border-t border-gray-200"> {{-- Garis pemisah --}}
                        <h3 class="text-2xl font-bold mb-4 text-red-700">Hapus Akun</h3>
                        <p class="text-base text-gray-700 mb-4">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                        <form method="POST" action="{{ route('user.profile.destroy') }}" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus akun Anda secara permanen? Tindakan ini tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <div class="mt-4">
                                <label for="password_confirmation" class="block font-semibold text-sm text-zinc-700 mb-1">Konfirmasi Password Anda untuk melanjutkan</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" required>
                                @error('password_confirmation')
                                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="mt-4 inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Hapus Akun <i class="ml-2 fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection