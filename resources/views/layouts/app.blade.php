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
<nav class="bg-blue-300 p-4 shadow-md flex justify-between items-center">
    <h1 class="text-white font-bold text-lg"> 📜Sistem Manajemen Tugas REG 📅</h1>
    <div>
        @auth
            <a href="{{ route('tasks.index') }}" class="text-white font-bold px-3">Task</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-white px-3 font-bold">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-white px-3">Login</a>
        @endauth
    </div>
</nav>
<main class="py-8">
    @yield('content')
</main>
</body>

</html>
