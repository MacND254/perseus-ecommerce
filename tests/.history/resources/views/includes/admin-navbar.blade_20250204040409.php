<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Brand/Logo -->
        <div class="text-xl font-semibold">Admin Panel | Perseus Enterprise</div>

        <!-- Right-aligned Links -->
        <ul class="flex space-x-6 items-center">
            <!-- Notifications Icon -->
            <li class="relative group">
                <a href="{{ route('admin.notifications.index') }}" class="flex items-center space-x-2 hover:text-gray-300 transition duration-200">
                    <!-- Notification Bell Icon -->
                    <x-heroicon-o-bell class="h-6 w-6" />
                    <!-- Notification Count (Optional) -->
                    <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
                </a>
                <!-- Notification Dropdown (Optional) -->
                <div class="absolute right-0 hidden mt-2 w-64 bg-gray-800 border border-gray-700 rounded-lg shadow-lg group-hover:block">
                    <div class="p-4">
                        <p class="text-sm font-semibold">Notifications</p>
                        <ul class="mt-2 space-y-2">
                            <li class="text-sm hover:bg-gray-700 p-2 rounded">New order received</li>
                            <li class="text-sm hover:bg-gray-700 p-2 rounded">System update available</li>
                            <li class="text-sm hover:bg-gray-700 p-2 rounded">New message from user</li>
                        </ul>
                    </div>
                </div>
            </li>

            <!-- User Profile and Name with Dropdown Menu -->
            <li class="relative group">
                <div class="flex items-center space-x-2">
                    <!-- Check if User is Authenticated -->
                    @auth
                        <!-- Logged in User's Name -->
                        <span class="text-white">{{ Auth::user()->name }}</span>

                        <!-- Profile Image with Dropdown -->
                        <div class="relative">
                            <button class="flex items-center space-x-2 group">
                                <!-- Display profile image or a placeholder if not set -->
                                <img src="{{ Auth::user()->profile_image_url ?? asset('default-profile-image.jpg') }}" alt="Profile" class="h-8 w-8 rounded-full border-2 border-gray-700">
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 hidden mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg group-hover:block">
                                <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">My Account</a>
                                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">Settings</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">Logout</a>
                            </div>
                        </div>
                    @else
                        <!-- Show Login or other options if the user is not authenticated -->
                        <span class="text-white">Guest</span>
                    @endauth
                </div>
            </li>
        </ul>
    </div>
</nav>
