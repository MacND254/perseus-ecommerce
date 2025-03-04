<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Guest')</title>

        <!-- Meta Tags for SEO -->
        <meta name="description" content="@yield('meta_description', 'Guest Area')">
        <meta name="keywords" content="@yield('meta_keywords', 'Guest, Public')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Global Styles -->

        @include('includes.styles')

        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="bg-gray-100 font-sans antialiased">
        <!-- Accessibility -->
        <a href="#main-content" class="sr-only focus:not-sr-only">Skip to content</a>

        <div class="min-h-screen flex flex-col justify-center items-center">
            <!-- Flash Messages -->
            @if (session('status'))
                <div class="alert alert-success my-4">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Main Content -->
            <main id="main-content" class="w-full max-w-md px-6">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('includes.footer')
        </div>

        <!-- Livewire Scripts -->
        @livewireScripts

        <!-- Global Scripts -->
        @include('includes.scripts')
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </body>
</html>
