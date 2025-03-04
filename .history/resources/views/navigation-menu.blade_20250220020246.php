<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Menu</title>



    @vite('resources/css/app.css') {{-- Ensure Tailwind is properly included --}}
</head>
<body class="bg-gray-100">

<nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">Perseus Enterprises</a>

        <!-- Desktop Navigation Links -->
        <ul class="hidden md:flex space-x-4">
            <li><a href="{{ route('home') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Home</a></li>
            <li><a href="{{ route('about-us.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">About Us</a></li>
            <li class="relative group">
                <a class="hover:bg-gray-700 px-3 py-2 rounded">Our Services</a>
                <ul class="absolute hidden group-hover:block bg-white text-gray-800 shadow-lg mt-2 rounded z-50 min-w-[180px]">
                    <li><a href="{{ route('services.managed-it') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">Managed IT Services</a></li>
                    <li><a href="{{ route('services.software-development') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">Software Development</a></li>
                    <li><a href="{{ route('services.it-consulting') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">IT Consulting</a></li>
                    <li><a href="{{ route('services.cloud-computing') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">Cloud Computing</a></li>
                    <li><a href="{{ route('services.cybersecurity') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">Cybersecurity</a></li>
                    <li><a href="{{ route('services.smart-home-automation') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">Smart-Home Automation</a></li>
                    <li><a href="{{ route('services.network-installations') }}" class="block px-2 py-1 whitespace-nowrap hover:bg-gray-100 text-sm">All Network Installations</a></li>
                </ul>
            </li>
            <li><a href="{{ route('career.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Career</a></li>
            <li><a href="{{ route('blog.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Blog</a></li>
            <li><a href="{{ route('products.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Shop</a></li>
            <li><a href="{{ route('contact-us.index') }}" class="hover:bg-gray-700 px-3 py-2 rounded">Contact Us</a></li>
        </ul>

        <ul>
            <div class="relative">
                <a href="javascript:void(0);" id="cartIcon" class="text-white">
                    🛒 <span id="cartCount" class="bg-red-500 text-white rounded-full px-2 text-sm">0</span>
                </a>
                @include('partials.cart-dropdown')
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

        <!-- Hamburger Menu for Mobile -->
        <div id="menu-toggle" class="menu-toggle md:hidden cursor-pointer flex flex-col space-y-1">
            <span class="block w-6 h-1 bg-white transition-transform"></span>
            <span class="block w-6 h-1 bg-white transition-transform"></span>
            <span class="block w-6 h-1 bg-white transition-transform"></span>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden fixed inset-0 bg-gray-800 bg-opacity-95 z-50">
        <div class="relative bg-gray-800 h-full w-1/2 px-4 py-2">
            <!-- Close Button -->
            <button id="menu-close" class="absolute top-4 right-4 text-white text-2xl font-bold">&times;</button>

            <a href="{{ route('home') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Home</a>
            <a href="{{ route('about-us.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">About Us</a>
            <div class="py-2 border-b border-gray-700">
                <a id="services-toggle" class="py-2 cursor-pointer block hover:bg-gray-700">Our Services</a>
                <div id="mobile-services-dropdown" class="hidden flex flex-col bg-gray-700">
                    <a href="{{ route('services.managed-it') }}" class="pl-4 py-2 hover:bg-gray-600">Managed IT Services</a>
                    <a href="{{ route('services.software-development') }}" class="pl-4 py-2 hover:bg-gray-600">Software Development</a>
                    <a href="{{ route('services.it-consulting') }}" class="pl-4 py-2 hover:bg-gray-600">IT Consulting</a>
                    <a href="{{ route('services.cloud-computing') }}" class="pl-4 py-2 hover:bg-gray-600">Cloud Computing</a>
                    <a href="{{ route('services.cybersecurity') }}" class="pl-4 py-2 hover:bg-gray-600">Cybersecurity</a>
                    <a href="{{ route('services.smart-home-automation') }}" class="pl-4 py-2 hover:bg-gray-600">Smart-Home Automation</a>
                    <a href="{{ route('services.network-installations') }}" class="pl-4 py-2 hover:bg-gray-600">All Network Installations</a>
                </div>
            </div>
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
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuClose = document.getElementById('menu-close');
        const servicesToggle = document.getElementById('services-toggle');
        const mobileServicesDropdown = document.getElementById('mobile-services-dropdown');

        if (menuToggle && mobileMenu && menuClose && servicesToggle && mobileServicesDropdown) {  // Check ALL elements
            // Open Mobile Menu
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });

            // Close Mobile Menu
            menuClose.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });

            // Close Mobile Menu on clicking outside
            mobileMenu.addEventListener('click', (event) => {
                if (event.target === mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Toggle Services Dropdown
            servicesToggle.addEventListener('click', () => {
                mobileServicesDropdown.classList.toggle('hidden');
            });
        } else {
            console.error("One or more elements not found:");
            if (!menuToggle) console.error("menuToggle is missing");
            if (!mobileMenu) console.error("mobileMenu is missing");
            if (!menuClose) console.error("menuClose is missing");
            if (!servicesToggle) console.error("servicesToggle is missing");
            if (!mobileServicesDropdown) console.error("mobileServicesDropdown is missing");
        }
    });
</script>
