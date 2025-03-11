<div class="flex-1">
    <!-- Sidebar -->
    <aside class="w-54 bg-gray-800 text-white min-h-screen p-4">
        <!-- Logo Container -->
        <div class="logo-container mb-6">
            <!-- Logo using the correct path -->
            <img src="{{ asset('assets/logo.ico') }}" alt="Logo" class="h-16 w-auto mx-auto">
        </div>
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    Dashboard
                </a>
            </li>

            <!-- User Management -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('user-management')">
                    User Management
                </button>
                <ul id="user-management" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.users.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Users</a></li>
                    <li><a href="{{ route('admin.admins.index') }}" class="block py-2 px-4 hover:bg-gray-600">Manage Admins</a></li>
                    <li><a href="{{ route('admin.roles.index') }}" class="block py-2 px-4 hover:bg-gray-600">Roles & Permissions</a></li>
                    <li><a href="{{ route('admin.users.logs') }}" class="block py-2 px-4 hover:bg-gray-600">Activity Logs</a></li>
                </ul>
            </li>

            <!-- Content Management -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('content-management')">
                    Content Management
                </button>
                <ul id="content-management" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.posts.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Posts</a></li>
                    <li><a href="{{ route('admin.posts.create') }}" class="block py-2 px-4 hover:bg-gray-600">Add New Post</a></li>
                     <!-- <li><a href="{{ route('admin.pages.index') }}" class="block py-2 px-4 hover:bg-gray-600">Pages</a></li> -->
                     <li><a href="{{ route('admin.post_categories.index') }}" class="block py-2 px-4 hover:bg-gray-600">Post Categories</a></li>
                </ul>
            </li>

            <!-- Page Management -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('page-management')">
                    Page Management
                </button>
                <ul id="page-management" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.careers.index') }}" class="block py-2 px-4 hover:bg-gray-600">Careers</a></li>
                    <li><a href="{{ route('admin.contact-us.index') }}" class="block py-2 px-4 hover:bg-gray-600">Contact Us</a></li>
                    <li><a href="{{ route('admin.messages.index') }}" class="block py-2 px-4 hover:bg-gray-600">Messages</a></li>
                    <li><a href="{{ route('admin.applications.index') }}" class="block py-2 px-4 hover:bg-gray-600">Applications</a></li>
                </ul>
            </li>

            <!-- Products Management -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('products-management')">
                    Products Management
                </button>
                <ul id="products-management" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.products.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Products</a></li>
                    <li><a href="{{ route('admin.products.create') }}" class="block py-2 px-4 hover:bg-gray-600">Add New Product</a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-gray-600">Products Categories</a></li>
                </ul>
            </li>

            <!-- Media Library -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('media-library')">
                    Media Library
                </button>
                <ul id="media-library" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.media.library') }}" class="block py-2 px-4 hover:bg-gray-600">Library</a></li>
                    <li><a href="{{ route('admin.media.upload') }}" class="block py-2 px-4 hover:bg-gray-600">Upload Media</a></li>
                </ul>
            </li>

            <!-- Themes -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('themes')">
                    Themes
                </button>
                <ul id="themes" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.themes.index') }}" class="block py-2 px-4 hover:bg-gray-600">Themes</a></li>
                    <li><a href="{{ route('admin.themes.customize') }}" class="block py-2 px-4 hover:bg-gray-600">Customize</a></li>
                </ul>
            </li>

            <!-- Plugins -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('plugins')">
                    Plugins
                </button>
                <ul id="plugins" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.plugins.index') }}" class="block py-2 px-4 hover:bg-gray-600">Installed Plugins</a></li>
                    <li><a href="{{ route('admin.plugins.install') }}" class="block py-2 px-4 hover:bg-gray-600">Install Plugin</a></li>
                </ul>
            </li>

            <!-- SEO Management -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('seo-management')">
                    SEO Management
                </button>
                <ul id="seo-management" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.seo.settings') }}" class="block py-2 px-4 hover:bg-gray-600">Settings</a></li>
                    <li><a href="{{ route('admin.seo.metadata') }}" class="block py-2 px-4 hover:bg-gray-600">Metadata</a></li>
                    <li><a href="{{ route('admin.seo.sitemap') }}" class="block py-2 px-4 hover:bg-gray-600">Sitemap</a></li>
                </ul>
            </li>

            <!-- Analytics -->
            <li>
                <a href="{{ route('admin.analytics.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    Analytics
                </a>
            </li>

            <!-- Backup & Restore -->
            <li class="relative">
                <button class="block py-2 px-4 w-full text-left hover:bg-gray-700 rounded" onclick="toggleDropdown('backup-restore')">
                    Backup & Restore
                </button>
                <ul id="backup-restore" class="hidden bg-gray-700 ml-4 rounded">
                    <li><a href="{{ route('admin.backup.create') }}" class="block py-2 px-4 hover:bg-gray-600">Backup</a></li>
                    <li><a href="{{ route('admin.backup.restore') }}" class="block py-2 px-4 hover:bg-gray-600">Restore</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100 p-6">
        <!-- Main content -->
    </main>
</div>

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const allDropdowns = document.querySelectorAll('ul[id^="user-management"], ul[id^="content-management"], ul[id^="media-library"], ul[id^="themes"], ul[id^="plugins"], ul[id^="seo-management"], ul[id^="backup-restore"]');

        // Close all dropdowns first
        allDropdowns.forEach(function (el) {
            if (el !== dropdown) {
                el.classList.add('hidden');
            }
        });

        // Toggle the clicked dropdown
        dropdown.classList.toggle('hidden');
    }
</script>
