@extends('components.admin_layout')

@section('title', 'Tambah Karya Seni Baru')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight"> {{-- Warna teks header --}}
        {{ __('Tambah Karya Seni Baru') }}
    </h2>
@endsection

@section('content')
    <div class="py-8 sm:py-12"> {{-- Sesuaikan padding vertikal --}}
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Ukuran tetap max-w-xl --}}
            <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 lg:p-8"> {{-- Kartu form --}}
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.arts.store') }}" enctype="multipart/form-data"> {{-- Pastikan action route benar --}}
                        @csrf

                        <div class="mb-4"> {{-- Margin bottom --}}
                            <label for="user_id" class="block font-semibold text-sm text-zinc-700 mb-1">Pemilik Karya (User)</label> {{-- Label style --}}
                            <select id="user_id" name="user_id" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20]" required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4"> {{-- Margin bottom --}}
                            <label for="title" class="block font-semibold text-sm text-zinc-700 mb-1">Judul Karya</label>
                            <input id="title" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" type="text" name="title" value="{{ old('title') }}" required autofocus />
                            @error('title')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4"> {{-- Margin bottom --}}
                            <label for="description" class="block font-semibold text-sm text-zinc-700 mb-1">Deskripsi Karya</label>
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full px-4 py-3 border border-[#163832] bg-[#DAF1DE] rounded-lg shadow-inner-sm focus:outline-none focus:ring-2 focus:ring-[#235347] focus:border-[#235347] transition duration-200 ease-in-out text-[#051F20] placeholder-zinc-500" required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6"> {{-- Margin bottom lebih besar --}}
                            <label for="image" class="block font-semibold text-sm text-zinc-700 mb-1">Gambar Karya</label>
                            <input id="image" type="file" name="image" class="block mt-1 w-full text-sm text-[#051F20] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#DAF1DE] file:text-[#0B2B26] hover:file:bg-[#8E8B9B] hover:file:text-white file:transition file:duration-150 file:ease-in-out cursor-pointer"> {{-- File input styling --}}
                            @error('image')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#163832] to-[#235347] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#0B2B26] hover:to-[#163832] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Unggah Karya') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection