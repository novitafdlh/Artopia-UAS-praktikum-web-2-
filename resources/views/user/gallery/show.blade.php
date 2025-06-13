@extends('components.user_layout')

@section('title', $art->title)

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight">
        {{ __('Detail Karya Seni') }}
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Bagian Kiri: Gambar Karya Seni --}}
                        <div class="relative group"> {{-- Menambahkan group untuk hover effect --}}
                            <img src="{{ Storage::url($art->image_path) }}" alt="{{ $art->title }}" class="w-full h-auto object-cover rounded-lg shadow-xl border-2 border-[#8E8B9B] transform group-hover:scale-[1.01] transition duration-300 ease-in-out"> {{-- Border Artopia & efek hover --}}
                            <div class="absolute inset-0 bg-[#0B2B26]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center"> {{-- Overlay pada hover --}}
                                <i class="fas fa-search-plus text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i> {{-- Icon zoom --}}
                            </div>
                        </div>
                        
                        {{-- Bagian Kanan: Detail Karya Seni --}}
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-extrabold mb-4 text-[#051F20] leading-tight">{{ $art->title }}</h1>
                            <p class="text-[#163832] text-lg mb-6 leading-relaxed">{{ $art->description }}</p> {{-- Warna teks lebih gelap, leading lebih longgar --}}
                            
                            <div class="mb-6">
                                <p class="text-[#235347] text-sm mb-2"><strong class="font-semibold">Diunggah oleh:</strong> {{ $art->user->name ?? 'Anonim' }}</p>
                                <p class="text-[#235347] text-sm"><strong class="font-semibold">Diunggah pada:</strong> {{ $art->created_at->format('d M Y, H:i') }}</p>
                            </div>

                            @auth
                                @can('manage-own-art', $art)
                                    <div class="mt-6 flex space-x-4">
                                        <a href="{{ route('user.artwork.edit', $art->id) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#235347] to-[#163832] border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-[#163832] hover:to-[#0B2B26] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                                            Edit Karya <i class="ml-2 fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.artwork.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus karya ini? Ini akan dihapus secara permanen!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Hapus Karya <i class="ml-2 fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                                @can('view-artwork', $art) {{-- Contoh permission lain jika ada --}}
                                    @unless(Auth::user()->can('manage-own-art', $art))
                                        <div class="mt-6">
                                            <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#DAF1DE] to-[#8E8B9B] border border-transparent rounded-lg font-bold text-base text-[#051F20] uppercase tracking-wider hover:from-[#8E8B9B] hover:to-[#235347] focus:outline-none focus:ring-2 focus:ring-[#0B2B26] focus:ring-offset-2 transition ease-in-out duration-150">
                                                Beli Karya Ini <i class="ml-2 fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    @endunless
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection