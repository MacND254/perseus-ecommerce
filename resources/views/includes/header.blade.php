<header class="bg-white shadow-sm border-b">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Mobile Toggle Button -->
        <button id="mobile-menu-toggle" class="lg:hidden text-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Desktop Navigation -->
        <nav class="space-x-4 hidden lg:flex">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
            <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-900">About</a>
            <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-900">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a>
            @endauth
        </nav>

        <!-- Mobile Navigation (hidden by default) -->
        <nav id="mobile-menu" class="lg:hidden hidden space-y-2 mt-2">
            <a href="{{ route('home') }}" class="block text-gray-600 hover:text-gray-900">Home</a>
            <a href="{{ route('about') }}" class="block text-gray-600 hover:text-gray-900">About</a>
            <a href="{{ route('contact') }}" class="block text-gray-600 hover:text-gray-900">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block text-gray-600 hover:text-gray-900">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block text-gray-600 hover:text-gray-900">Login</a>
                <a href="{{ route('register') }}" class="block text-gray-600 hover:text-gray-900">Register</a>
            @endauth
        </nav>
    </div>
</header>
