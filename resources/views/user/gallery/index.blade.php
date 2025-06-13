@extends('components.user_layout')

@section('title', 'Galeri Artopia')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight">
        {{ __('Galeri Artopia') }}
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

            <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 lg:p-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-[#051F20] mb-6">Jelajahi Koleksi Karya Seni Artopia</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-h-[600px] overflow-y-auto pr-2">
                        @forelse ($arts as $art)
                            <div class="relative bg-gradient-to-br from-[#163832] to-[#0B2B26] rounded-xl shadow-lg overflow-hidden group transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer border border-[#DAF1DE]"> 
                                <a href="{{ route('user.gallery.show', $art->id) }}">
                                    <img src="{{ Storage::url($art->image_path) }}" alt="{{ $art->title }}" class="w-full h-64 object-cover object-center transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#051F20]/70 to-transparent transition-all duration-300 opacity-0 group-hover:opacity-100"></div> 
                                    
                                    <div class="p-4 relative z-10 text-white">
                                        <h3 class="text-xl font-bold mb-1 truncate">{{ $art->title }}</h3> 
                                        <p class="text-[#DAF1DE] text-sm mb-2">Oleh: {{ $art->user->name ?? 'Anonim' }}</p>
                                        <p class="text-xs text-[#8E8B9B] line-clamp-2">{{ Str::limit($art->description, 100) }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-600 text-lg py-10">Belum ada karya seni yang diunggah di galeri ini.</p>
                        @endforelse
                    </div>

                    <div class="mt-10 flex justify-center">
                        {{ $arts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection