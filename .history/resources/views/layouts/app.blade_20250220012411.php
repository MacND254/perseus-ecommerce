<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Home')</title>

        <!-- Meta Tags for SEO -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="keywords" content="@yield('meta_keywords', 'Default Keywords')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Global Styles -->
        @include('includes.styles')



        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <!-- Accessibility -->
        <a href="#main-content" class="sr-only focus:not-sr-only">Skip to content</a>

        <!-- Banner -->
        @if (View::hasSection('banner'))
            @yield('banner')
        @endif

        <div class="min-h-screen">
            <!-- Navigation Menu -->
            @livewire('navigation-menu')

            @if (View::hasSection('slider'))
            <section class="slider-section">
                @yield('slider')
            </section>
        @endif

            <!-- Page Heading -->
            @if (View::hasSection('header'))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Flash Messages -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Page Content -->
            <main id="main-content">
                {{-- Render slot if defined, otherwise render @yield('content') --}}
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        @include('includes.footer')

        <!-- Modals -->
        @stack('modals')

        <!-- Livewire Scripts -->
        @livewireScripts

        <!-- Global Scripts -->
        @include('includes.scripts')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/cart.js') }}"></script>



    </body>
</html>
