<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin - @yield('title', config('app.name', 'Artopia'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            /* Latar belakang umum untuk Artopia */
            body.artopia-bg {
                background: linear-gradient(to bottom right, #DAF1DE, #8E8B9B); /* Gradasi background lembut */
            }
        </style>
    </head>
    <body class="font-sans antialiased artopia-bg"> {{-- Tambahkan kelas artopia-bg di body --}}
        <div class="min-h-screen flex flex-col" x-data="{ open: false }">

            <nav class="bg-[#0B2B26] border-b border-[#163832] py-4 shadow-xl"> {{-- Warna navbar dan shadow lebih kuat --}}
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-[#DAF1DE] font-semibold text-xl tracking-wider hover:text-white transition duration-150">
                            <i class="fas fa-palette mr-2 text-[#8E8B9B]"></i> Admin Artopia {{-- Icon diganti palet --}}
                        </a>
                        <div class="hidden sm:flex ml-10 space-x-6">
                            <a href="{{ route('admin.dashboard') }}" class="text-[#DAF1DE] hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-[#235347] text-white' : '' }} transition duration-150">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.user.index') }}" class="text-[#DAF1DE] hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.user.*') ? 'bg-[#235347] text-white' : '' }} transition duration-150">
                                <i class="fas fa-users mr-1"></i> Users
                            </a>
                            <a href="{{ route('admin.arts.index') }}" class="text-[#DAF1DE] hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.artwork.*') ? 'bg-[#235347] text-white' : '' }} transition duration-150">
                                <i class="fas fa-paint-brush mr-1"></i> Artworks
                            </a>
                        </div>
                    </div>

                    {{-- Dropdown untuk Pengguna (Hanya Log Out) --}}
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#DAF1DE] bg-[#0B2B26] hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                style="display: none;">
                                
                                {{-- Hanya form Log Out --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-[#051F20] hover:bg-gray-100"> {{-- Warna teks logout --}}
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile toggle button --}}
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#DAF1DE] hover:text-white hover:bg-[#235347] focus:outline-none focus:bg-[#235347] focus:text-white transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>

            {{-- Mobile navigation menu --}}
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0B2B26]"> {{-- Warna bg mobile nav --}}
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-[#DAF1DE] hover:bg-[#235347] {{ request()->routeIs('admin.dashboard') ? 'bg-[#235347]' : '' }} transition duration-150">
                        <i class="fas fa-tachometer-alt mr-1"></i> {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.user.index') }}" class="block px-4 py-2 text-base font-medium text-[#DAF1DE] hover:bg-[#235347] {{ request()->routeIs('admin.user.*') ? 'bg-[#235347]' : '' }} transition duration-150">
                        <i class="fas fa-users mr-1"></i> {{ __('Users') }}
                    </a>
                    <a href="{{ route('admin.arts.index') }}" class="block px-4 py-2 text-base font-medium text-[#DAF1DE] hover:bg-[#235347] {{ request()->routeIs('admin.artwork.*') ? 'bg-[#235347]' : '' }} transition duration-150">
                        <i class="fas fa-paint-brush mr-1"></i> {{ __('Artworks') }}
                    </a>
                </div>

                <div class="pt-4 pb-1 border-t border-[#163832]"> {{-- Warna border mobile nav --}}
                    <div class="px-4">
                        <div class="font-medium text-base text-[#DAF1DE]">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-[#8E8B9B]">{{ Auth::user()->email }}</div> {{-- Warna email mobile nav --}}
                    </div>

                    <div class="mt-3 space-y-1">
                        {{-- Hanya form Log Out di mobile --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-base font-medium text-[#DAF1DE] hover:bg-[#235347] transition duration-150">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Page Heading (jika ada) --}}
            @hasSection('header')
                <header class="bg-white shadow-sm"> {{-- Ubah warna header --}}
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            {{-- Main content area --}}
            <main class="flex-grow p-6"> {{-- Tambah padding --}}
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="bg-[#0B2B26] text-[#DAF1DE] py-6 mt-auto shadow-inner"> {{-- Warna footer --}}
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
                    <p>&copy; {{ date('Y') }} Artopia Admin Panel. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>