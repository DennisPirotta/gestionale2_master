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
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 fancy-scrollbar">
        <x-banner />

        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="md:ml-64 mt-16 md:mb-0 mb-16 md:p-8 p-3">
            {{ $slot }}
        </main>

        @stack('modals')

        @livewireScripts
    </body>
</html>
