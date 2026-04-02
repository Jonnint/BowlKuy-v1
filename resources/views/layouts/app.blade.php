<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/fonts/figtree.css') }}">

    <script defer src="{{ asset('assets/vendor/alpinejs/cdn.min.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#121212] text-white">
    <div class="min-h-screen bg-[#121212]">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-[#1e1e1e] border-b border-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-yellow-400 leading-tight">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
