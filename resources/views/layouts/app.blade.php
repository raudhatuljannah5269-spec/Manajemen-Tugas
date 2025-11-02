<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-blue-100 font-[Poppins] min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-300 p-4 shadow-md flex justify-between items-center">
        <h1 class="text-white font-bold text-lg">
            📜 Sistem Manajemen Tugas REG 📅
        </h1>

        <div class="flex items-center space-x-4">
            @auth
                <!-- Foto Profil -->
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                             alt="Foto Profil"
                             class="w-8 h-8 rounded-full border-2 border-white object-cover">
                    @else
                        <div class="w-8 h-8 rounded-full bg-white text-blue-500 flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <span class="text-white font-semibold truncate max-w-[120px]">
                        {{ Auth::user()->name }}
                    </span>
                </a>

                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-white px-3 font-bold hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white px-3">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Header -->
    @if (isset($header))
        <header class="bg-white shadow mt-4 mx-auto max-w-5xl rounded-xl">
            <div class="py-6 px-6 text-center">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Main content -->
    <main class="py-10 px-6 flex justify-center">
        <div class="w-full max-w-5xl">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
