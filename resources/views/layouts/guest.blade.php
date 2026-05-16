<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Benang Kasih') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-[#5C4033] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#FDFBF7] relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#E8EFE9] rounded-full blur-3xl opacity-40 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#F5EFE6] rounded-full blur-3xl opacity-60 translate-x-1/2 translate-y-1/2"></div>

            <div class="mb-2 relative z-10 text-center">
                <a href="/" class="text-2xl font-bold tracking-widest text-[#4A6B51] drop-shadow-sm">
                    BENANG <span class="text-[#8C7A6B]">KASIH</span>
                </a>
                <div class="w-12 h-[2px] bg-[#4A6B51] mx-auto mt-1 opacity-50"></div>
            </div>

            <div class="w-full sm:max-w-md mt-6 relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>