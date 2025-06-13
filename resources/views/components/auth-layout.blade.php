@props(['title', 'section_title', 'section_description'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Tailwind CSS dan JavaScript Anda --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Phosphor Icons --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.0.2/src/regular/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">

    <title>{{ $title ?? 'Artopia - Akses' }}</title>

    <style>
        /* CSS kustom untuk latar belakang dan gradasi menggunakan palet Anda */
        .artopia-gradient-bg {
            background-color: #163832; /* Warna dasar */
            background-image: linear-gradient(to bottom right, #051F20, #163832, #235347);
        }
        .artopia-background-image {
            /* Ganti dengan path gambar Anda yang hanya background dengan kuas */
            background-image: url('{{ asset('images/artopia-login-background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        {{-- Bagian Kiri (Gambar Background dan Teks) --}}
        <div class="hidden lg:flex w-1/2 artopia-gradient-bg items-center justify-center relative p-8">
            <div class="absolute inset-0 artopia-background-image opacity-80"></div>
            <div class="absolute inset-0 bg-[#0B2B26]/60"></div> {{-- Overlay gelap untuk kontras teks --}}

            <div class="relative z-10 text-white text-center">
                <h1 class="text-5xl font-extrabold tracking-tight mb-4 leading-tight">Online Gallery</h1>
                <p class="text-xl text-[#DAF1DE] font-light">Welcome to the Artopia website</p>
            </div>
        </div>

        {{-- Bagian Kanan (Form Wrapper) --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white relative p-6 sm:p-8 lg:p-12">
            <div class="max-w-md w-full">
                {{-- Logo dan Nama Aplikasi di atas form --}}
                <div class="flex gap-2 justify-center items-center mb-8">
                    <i class="ph ph-palette-fill inline-block text-4xl text-[#163832]"></i>
                    <p class="font-bold text-xl text-[#0B2B26]">Artopia</p>
                </div>

                {{-- Judul bagian form --}}
                <div class="text-center mb-6">
                    <h1 class="font-extrabold text-3xl text-[#051F20] mb-2">{{ $section_title ?? 'Selamat Datang' }}</h1>
                    <p class="text-zinc-600 text-sm">{{ $section_description ?? 'Silahkan lanjutkan.' }}</p>
                </div>

                {{-- Slot untuk konten form (input fields, tombol, dll.) --}}
                @yield('form_content')
            </div>
        </div>
    </div>
</body>

</html>