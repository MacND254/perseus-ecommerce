<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Careers')</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Include navigation -->
    @include('partials.navigation-menu')

    <!-- Header Section -->
    <header class="relative w-full h-64 bg-gray-800 text-white">
        <img
            src="{{ asset('images/careers-header.jpg') }}"
            alt="Careers Header"
            class="absolute inset-0 w-full h-full object-cover opacity-70"
        >
        <div class="relative z-10 flex items-center justify-center h-full">
            <h1 class="text-4xl font-bold">Available Positions</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        @yield('content')
    </main>

    <!-- Footer (optional) -->
    <footer class="mt-12 bg-gray-100 p-4 text-center">
        <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </footer>
</body>
</html>
