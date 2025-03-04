<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Menu</title>



    @vite('resources/css/app.css') {{-- Ensure Tailwind is properly included --}}
</head>
<body>

<nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Perseus Enterprises</a>

        <!-- Desktop Navigation Links -->
        <ul class="hidden md:flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Home</a></li>
            <li><a href="{{ route('about-us.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">About Us</a></li>
            <li><a href="{{ route('services.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Services</a></li>
            <li><a href="{{ route('career.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Career</a></li>
            <li><a href="{{ route('blog.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Blog</a></li>
            <li><a href="{{ route('products.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Shop</a></li>
            <li><a href="{{ route('contact-us.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Contact Us</a></li>
        </ul>

        <ul>
            <div class="relative">
                <a href="javascript:void(0);" id="cartIcon" class="relative">
                    🛒<span id="cartCount" class="bg-red-500 text-white rounded-full px-2 text-sm">{{ $cartCount ?? 0 }}</span>
                </a>

                @auth
                    @include('partials.cart-dropdown', [
                        'cartItems' => \App\Models\CartItem::whereHas('cart', function ($query) {
                            $query->where('user_id', Auth::id())->where('status', 'active');
                        })->with('product')->get(),
                        'subtotal' => \App\Models\Cart::where('user_id', Auth::id())->where('status', 'active')->value('total') ?? 0,
                        'vat' => (\App\Models\Cart::where('user_id', Auth::id())->where('status', 'active')->value('total') ?? 0) * 0.16,
                        'total' => (\App\Models\Cart::where('user_id', Auth::id())->where('status', 'active')->value('total') ?? 0) * 1.16,
                        'cartCount' => \App\Models\CartItem::whereHas('cart', function ($query) {
                            $query->where('user_id', Auth::id())->where('status', 'active');
                        })->sum('quantity')
                    ])
                @endauth
            </div>
        </ul>


        <!-- Auth Links -->
        <div class="hidden md:flex space-x-4">
            @guest
                <a href="{{ route('login') }}"
                   class="px-3 py-2 rounded-[8px] font-semibold text-sm relative overflow-hidden transition-colors duration-300 ease-in-out"
                   style="background: linear-gradient(to right, #4B0082, #8A2BE2); /* Purple to dark purple gradient */
                          color: white; /* Text color */
                          box-shadow: 0 0 10px rgba(75, 0, 130, 0.3); /* Initial glow */
                          "
                   onmouseover="this.style.background = 'linear-gradient(to right, #8A2BE2, #4B0082)'; /* Reverse gradient on hover */
                              this.style.boxShadow = '0 0 20px rgba(75, 0, 130, 0.5)'; /* Stronger glow on hover */"
                   onmouseout="this.style.background = 'linear-gradient(to right, #4B0082, #8A2BE2)'; /* Restore original gradient */
                             this.style.boxShadow = '0 0 10px rgba(75, 0, 130, 0.3)'; /* Restore original glow */">
                    <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 ease-in-out"
                          style="pointer-events: none;"></span> <span class="relative">Sign In</span>
                </a>

                <a href="{{ route('register') }}"
                   class="px-3 py-2 rounded-[8px] font-semibold text-sm relative overflow-hidden transition-colors duration-300 ease-in-out"
                   style="background: linear-gradient(to right, #4B0082, #8A2BE2); /* Purple to dark purple gradient */
                          color: white; /* Text color */
                          box-shadow: 0 0 10px rgba(75, 0, 130, 0.3); /* Initial glow */
                          "
                   onmouseover="this.style.background = 'linear-gradient(to right, #8A2BE2, #4B0082)'; /* Reverse gradient on hover */
                              this.style.boxShadow = '0 0 20px rgba(75, 0, 130, 0.5)'; /* Stronger glow on hover */"
                   onmouseout="this.style.background = 'linear-gradient(to right, #4B0082, #8A2BE2)'; /* Restore original gradient */
                             this.style.boxShadow = '0 0 10px rgba(75, 0, 130, 0.3)'; /* Restore original glow */">
                    <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 ease-in-out"
                          style="pointer-events: none;"></span> <span class="relative">Sign Up</span>
                </a>
            @else
                <div class="relative group">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <span class="text-white">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-lg mt-2 rounded z-50 min-w-[160px]">
                        <li><a href="{{ route('dashboard') }}" class="block px-4 py-5 hover:bg-gray-100">Dashboard</a></li>
                        <li><a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>

         <!-- Mobile Menu Toggle -->
         <button id="menu-toggle" class="md:hidden flex flex-col space-y-1">
            <span class="block w-6 h-1 bg-white transition-all duration-300"></span>
            <span class="block w-6 h-1 bg-white transition-all duration-300"></span>
            <span class="block w-6 h-1 bg-white transition-all duration-300"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden fixed top-[56px] left-0 w-1/2 h-[calc(100%-60px)]  bg-opacity-50 backdrop-blur-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50 flex flex-col">

        <div class="relative w-1/2 h-full w-full bg-gray-400 bg-opacity-50 p-6">
            <button id="menu-close" class="absolute top-4 right-4 text-white text-3xl">&times;</button>

            <a href="{{ route('home') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Home</a>
            <a href="{{ route('about-us.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">About Us</a>
            <a href="{{ route('services.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Our Services</a>
            <a href="{{ route('career.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Career</a>
            <a href="{{ route('blog.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Blog</a>
            <a href="{{ route('products.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Shop</a>
            <a href="{{ route('contact-us.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Contact Us</a>

            <div class="flex flex-col space-y-2 mt-2">
                @guest
                    <a href="{{ route('login') }}"
                       class="px-3 py-2 rounded-[8px] font-semibold text-sm relative overflow-hidden transition-colors duration-300 ease-in-out"
                       style="background: linear-gradient(to right, #4B0082, #8A2BE2); /* Purple to dark purple gradient */
                              color: white; /* Text color */
                              box-shadow: 0 0 10px rgba(75, 0, 130, 0.3); /* Initial glow */
                              "
                       onmouseover="this.style.background = 'linear-gradient(to right, #8A2BE2, #4B0082)'; /* Reverse gradient on hover */
                                  this.style.boxShadow = '0 0 20px rgba(75, 0, 130, 0.5)'; /* Stronger glow on hover */"
                       onmouseout="this.style.background = 'linear-gradient(to right, #4B0082, #8A2BE2)'; /* Restore original gradient */
                                 this.style.boxShadow = '0 0 10px rgba(75, 0, 130, 0.3)'; /* Restore original glow */">
                        <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 ease-in-out"
                              style="pointer-events: none;"></span> <span class="relative">Sign In</span>
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-3 py-2 rounded-[8px] font-semibold text-sm relative overflow-hidden transition-colors duration-300 ease-in-out"
                       style="background: linear-gradient(to right, #4B0082, #8A2BE2); /* Purple to dark purple gradient */
                              color: white; /* Text color */
                              box-shadow: 0 0 10px rgba(75, 0, 130, 0.3); /* Initial glow */
                              "
                       onmouseover="this.style.background = 'linear-gradient(to right, #8A2BE2, #4B0082)'; /* Reverse gradient on hover */
                                  this.style.boxShadow = '0 0 20px rgba(75, 0, 130, 0.5)'; /* Stronger glow on hover */"
                       onmouseout="this.style.background = 'linear-gradient(to right, #4B0082, #8A2BE2)'; /* Restore original gradient */
                                 this.style.boxShadow = '0 0 10px rgba(75, 0, 130, 0.3)'; /* Restore original glow */">
                        <span class="absolute inset-0 bg-white opacity-0 transition-opacity duration-300 ease-in-out"
                              style="pointer-events: none;"></span> <span class="relative">Sign Up</span>
                    </a>
                @else
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-[8px] font-semibold text-sm bg-gray-700 text-white">Dashboard</a>
                        <a href="{{ route('profile.show') }}" class="px-3 py-2 rounded-[8px] font-semibold text-sm bg-gray-700 text-white">Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-3 py-2 rounded-[8px] font-semibold text-sm bg-gray-700 text-white text-left">Log Out</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <div class="mt-auto text-center text-white text-sm py-4 border-t border-gray-700">
        &copy; 2025 Perseud
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClose = document.getElementById('menu-close');

        const openMenu = () => {
        mobileMenu.classList.remove('-translate-x-full'); // Move menu into view
        document.body.classList.add('overflow-hidden');
    };

    const closeMenu = () => {
        mobileMenu.classList.add('-translate-x-full'); // Move menu out of view
        document.body.classList.remove('overflow-hidden');
    };

        // Open menu when clicking the hamburger button
        menuToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            openMenu();
        });

         // Close menu when clicking the close button
    menuClose.addEventListener('click', (event) => {
        event.stopPropagation();
        closeMenu();
    });

    // Close menu when clicking outside of it
    document.addEventListener('click', (event) => {
        if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
            closeMenu();
        }
    });

        // Prevent event bubbling inside the menu
        mobileMenu.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        console.log("✅ Mobile menu script loaded successfully.");
    });
</script>



</body>
</html>
