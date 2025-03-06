
<footer class="bg-gray-500 border-t mt-8">
    <div class="container mx-auto px-4 py-6 text-center">
        <p class="text-sm text-gray-900">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </p>
        <div class="space-x-4 mt-2">



            @auth
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900">Admin Dashboard</a>
            @endauth
        </div>
    </div>
</footer>
