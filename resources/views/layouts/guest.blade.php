<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/figtree.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#121212]">
        <div>
            <a href="/">
                <h1 class="text-4xl font-bold text-white">Bowl<span class="text-yellow-400">Kuy</span></h1>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-[#1e1e1e] shadow-2xl overflow-hidden sm:rounded-2xl border border-gray-800">
            {{ $slot }}
        </div>
    </div>
    
    <!-- Connection Monitor -->
    <script src="{{ asset('assets/js/connection-monitor.js') }}"></script>
</body>

</html>
