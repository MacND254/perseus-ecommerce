<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-200" style="background: url('{{ asset('images/login.png') }}') no-repeat center center/cover;">
    <div class="w-full max-w-md p-8 bg-white bg-opacity-60 rounded-lg shadow-lg backdrop-blur-md">
        <h2 class="text-2xl font-bold text-center text-gray-800">Create an Account</h2>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="mt-6">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <button type="button" onclick="togglePassword('password', 'togglePasswordBtn')"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                    👁
                </button>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                <button type="button" onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordBtn')"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700">
                    👁
                </button>
            </div>

            <!-- Terms & Conditions -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="terms" id="terms" required class="mr-2">
                    <label for="terms" class="text-gray-600 text-sm">
                        I agree to the
                        <a href="{{ route('terms.show') }}" class="text-blue-500 underline">Terms of Service</a>
                        and
                        <a href="{{ route('policy.show') }}" class="text-blue-500 underline">Privacy Policy</a>.
                    </label>
                </div>
            @endif

            <!-- Register Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-gray-700">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a>
        </p>
    </div>

    <script>
        function togglePassword(inputId, btnId) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>
