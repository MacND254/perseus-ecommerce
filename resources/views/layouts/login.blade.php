<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="w-full max-w-md p-6 bg-white shadow-md rounded-lg">
        <!-- Dynamic Page Title -->
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">
            @yield('title', 'Login')
        </h2>

        @yield('content') <!-- Content for login form -->

        <p class="text-center text-sm text-gray-600 mt-4">
            © {{ date('Y') }} Your Company. All rights reserved.
        </p>
    </div>

</body>
</html>
