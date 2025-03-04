<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-xl font-semibold">Admin Panel | Perseus Enterprise</div>
        <ul class="flex space-x-6">

            <!-- Notifications Icon -->
            <li class="relative">
                <a href="{{ route('admin.notifications.index') }}" class="flex items-center space-x-2 hover:text-gray-300">
                    <x-heroicon-o-bell class="h-6 w-6" />
                    <span class="hidden group-hover:inline">Notifications</span>
                </a>
            </li>

            <!-- User Profile and Name with Dropdown Menu -->
            <li class="relative">
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
                                <span class="hidden group-hover:inline">Profile</span>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 hidden mt-2 space-y-2 w-40 bg-gray-800 text-white border border-gray-700 rounded-lg shadow-md group-hover:block">
                                <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 hover:bg-gray-700">My Account</a>
                                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-gray-700">Settings</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-700">Logout</a>
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
