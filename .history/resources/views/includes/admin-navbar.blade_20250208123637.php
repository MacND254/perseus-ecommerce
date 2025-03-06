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

            <!-- Logged-in User's Name -->
            @auth
                <li class="text-white">
                    {{ Auth::user()->name }}
                </li>
            @endauth

            <!-- User Profile Icon with Dropdown Menu -->
            <li class="relative">
                <!-- Clickable Profile Icon -->
                <button id="profile-dropdown-toggle" class="flex items-center hover:text-gray-300 transition duration-200">
                    <!-- User Icon from W3Schools (replace with your preferred icon) -->
                    <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="profile-dropdown" class="absolute right-0 hidden mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg">
                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">My Account</a>
                    <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">Settings</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-red-300 hover:text-red-500">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- JavaScript to Toggle Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileDropdownToggle = document.getElementById('profile-dropdown-toggle');
        const profileDropdown = document.getElementById('profile-dropdown');

        // Toggle dropdown on icon click
        profileDropdownToggle.addEventListener('click', function () {
            profileDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!profileDropdownToggle.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    });
</script>
