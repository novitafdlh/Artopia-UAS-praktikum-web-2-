<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Artopia'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Latar belakang umum untuk Artopia */
        body.artopia-bg-light {
            background: linear-gradient(to bottom right, #DAF1DE, #8E8B9B); /* Gradasi background lembut dari palet lighter ke light */
        }
    </style>
</head>
<body class="font-sans antialiased artopia-bg-light"> {{-- Gunakan kelas background Artopia --}}
    <div class="min-h-screen flex flex-col" x-data="{ open: false }">

        <nav class="bg-white border-b border-[#DAF1DE] py-4 shadow-sm"> {{-- Navbar putih dengan border dari palet lighter --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center text-[#051F20] font-semibold text-xl tracking-wider hover:text-[#0B2B26] transition duration-150">
                        <i class="fas fa-palette mr-2 text-[#235347]"></i> Artopia {{-- Icon palet dan warna dari palet DEFAULT --}}
                    </a>
                    <div class="hidden sm:flex ml-10 space-x-6">
                        <a href="{{ route('user.dashboard') }}" class="text-[#163832] hover:text-[#051F20] px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.dashboard') ? 'bg-[#DAF1DE]' : '' }} transition duration-150"> {{-- Warna teks nav, hover, dan aktif --}}
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('user.gallery.index') }}" class="text-[#163832] hover:text-[#051F20] px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.gallery.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                            {{ __('Galeri') }}
                        </a>
                        @auth
                            <a href="{{ route('user.artwork.index') }}" class="text-[#163832] hover:text-[#051F20] px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.artwork.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150"> {{-- Sesuaikan routeIs untuk Karya Saya --}}
                                {{ __('Karya Saya') }}
                            </a>
                            @can('access-admin-panel')
                                <a href="{{ route('admin.dashboard') }}" class="text-[#163832] hover:text-[#051F20] px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                                    {{ __('Admin Panel') }}
                                </a>
                            @endcan
                        @endauth
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                            <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#163832] bg-white hover:text-[#051F20] focus:outline-none transition ease-in-out duration-150"> {{-- Warna tombol dropdown --}}
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
                                
                                <a href="{{ route('user.profile.index') }}" class="block px-4 py-2 text-sm text-[#051F20] hover:bg-gray-100 transition duration-150"> {{-- Warna link dropdown --}}
                                    Profil Saya
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-[#051F20] hover:bg-gray-100 transition duration-150">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-[#163832] hover:text-[#051F20] focus:outline focus:outline-2 focus:rounded-sm focus:outline-[#8E8B9B] transition duration-150">Log in</a>
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-[#163832] hover:text-[#051F20] focus:outline focus:outline-2 focus:rounded-sm focus:outline-[#8E8B9B] transition duration-150">Register</a>
                    @endauth
                </div>

                {{-- Mobile toggle button --}}
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#163832] hover:text-[#051F20] hover:bg-[#DAF1DE] focus:outline-none focus:bg-[#DAF1DE] focus:text-[#051F20] transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        {{-- Mobile navigation menu --}}
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white"> {{-- Latar belakang menu mobile --}}
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE] {{ request()->routeIs('user.dashboard') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('user.gallery.index') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE] {{ request()->routeIs('user.gallery.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                    {{ __('Galeri') }}
                </a>
                @auth
                    <a href="{{ route('user.artwork.index') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE] {{ request()->routeIs('user.artwork.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                        {{ __('Karya Saya') }}
                    </a>
                    @can('access-admin-panel')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE] {{ request()->routeIs('admin.*') ? 'bg-[#DAF1DE]' : '' }} transition duration-150">
                            {{ __('Admin Panel') }}
                        </a>
                    @endcan
                @endauth
            </div>
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-[#051F20]">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-[#163832]">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('user.profile.index') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE]">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-base font-medium text-[#163832] hover:bg-[#DAF1DE]">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4 space-y-1">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE]">Log in</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-[#163832] hover:bg-[#DAF1DE]">Register</a>
                    </div>
                </div>
            @endauth
        </div>

        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-[#0B2B26] text-[#DAF1DE] py-6 mt-auto shadow-inner">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Artopia. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>