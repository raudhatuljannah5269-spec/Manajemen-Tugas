<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- Ubah background seluruh halaman -->
    <body class="font-sans text-gray-900 antialiased bg-blue-200">
        <div class="min-h-screen flex flex-col justify-center items-center">

            <!-- Logo -->
            <div class="mb-6">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-600" />
                </a>
            </div>

            <!-- Box login (hilangkan background putih jika mau full biru) -->
            <div class="w-full sm:max-w-md px-6 py-4 bg-blue-100/60 shadow-xl rounded-2xl backdrop-blur-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
