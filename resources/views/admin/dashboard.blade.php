@extends('components.admin_layout')

@section('title', 'Dashboard Admin')

@section('header')
    <h2 class="font-semibold text-xl text-[#051F20] leading-tight"> 
        {{ __('Panel Admin Artopia') }}
    </h2>
@endsection

@section('content')
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <h3 class="text-2xl font-bold text-[#051F20] mb-6">Selamat datang di Panel Admin Artopia!</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 

                        <div class="bg-gradient-to-br from-[#235347] to-[#163832] p-6 rounded-lg shadow-lg text-white transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer">
                            <h4 class="text-xl font-semibold mb-3">Total Users</h4>
                            <p class="text-4xl font-extrabold mb-4">{{ $totalUsers }}</p>
                            <p class="text-[#DAF1DE] mb-4 text-sm">Kelola semua akun pengguna yang terdaftar di Artopia.</p>
                            <a href="{{ route('admin.user.index') }}" class="inline-flex items-center px-4 py-2 bg-[#0B2B26] border border-transparent rounded-md font-semibold text-xs text-[#DAF1DE] uppercase tracking-wider hover:bg-[#051F20] focus:outline-none focus:ring-2 focus:ring-[#8E8B9B] focus:ring-offset-2 transition ease-in-out duration-150">
                                Lihat & Kelola User <i class="ml-2 fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="bg-gradient-to-br from-[#8E8B9B] to-[#235347] p-6 rounded-lg shadow-lg text-[#051F20] transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer">
                            <h4 class="text-xl font-semibold mb-3">Total Karya Seni</h4>
                            <p class="text-4xl font-extrabold mb-4">{{ $totalArts }}</p>
                            <p class="text-[#0B2B26] mb-4 text-sm">Tinjau dan kelola semua karya seni yang diunggah oleh pengguna.</p>
                            <a href="{{ route('admin.arts.index') }}" class="inline-flex items-center px-4 py-2 bg-[#0B2B26] border border-transparent rounded-md font-semibold text-xs text-[#DAF1DE] uppercase tracking-wider hover:bg-[#051F20] focus:outline-none focus:ring-2 focus:ring-[#DAF1DE] focus:ring-offset-2 transition ease-in-out duration-150">
                                Lihat & Kelola Artwork <i class="ml-2 fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection