<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }} - @yield('title', 'Admin Panel')</title>

        <!-- Meta Tags for SEO -->
        <meta name="description" content="@yield('meta_description', 'Admin Panel')">
        <meta name="keywords" content="@yield('meta_keywords', 'Admin, CMS')">

        <!-- Global Styles -->
        @include('includes.styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <script src="https://cdn.tiny.cloud/1/guzu876cwz7nfbdz63bqn9tjotazov9bz8lkdiz7le8h9ex1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>-->


        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-600">
        <!-- Accessibility -->
        <a href="#main-content" class="sr-only focus:not-sr-only">Skip to content</a>

        <div class="admin-wrapper min-h-screen flex w-full">
            <!-- Sidebar -->
            @include('includes.sidebar')

            <div class="admin-content flex-1">
                <!-- Top Navigation Bar -->
                @include('includes.admin-navbar')

                <!-- Flash Messages -->
                @if (session('status'))
                    <div class="alert alert-success mx-4 my-2">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-4 px-6">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main id="main-content" class="p-6">
                    @yield('content')  <!-- This is the content injected from the child views -->
                </main>

                <!-- Footer -->
                @include('includes.admin_footer')
            </div>
        </div>

        <!-- Modals -->
        @stack('modals')

        <!-- Livewire Scripts -->
        @livewireScripts

        <!-- Global Scripts -->
        @include('includes.scripts')



    </body>
</html>
