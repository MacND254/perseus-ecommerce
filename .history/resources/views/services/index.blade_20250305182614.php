@extends('layouts.app')

@section('title', 'Our Services | Perseus eCommerce')

@section('content')
<section class="container mx-auto py-12 px-6">
    <!-- Page Heading -->
    <h1 class="text-4xl font-bold text-center text-green">Our Services</h1>
    <p class="text-lg text-center text-gray-600 mt-2">We offer a wide range of IT services to help your business thrive.</p>

    <!-- Services Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
        <!-- Managed IT Services -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Managed IT Services</h2>
            <p class="text-gray-700">Comprehensive IT support, monitoring, and maintenance to keep your systems running smoothly.</p>
            <a href="{{ route('services.managed-it') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- Software Development -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Software Development</h2>
            <p class="text-gray-700">Custom web, mobile, and desktop applications tailored to your business needs.</p>
            <a href="{{ route('services.software-development') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- IT Consulting -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">IT Consulting</h2>
            <p class="text-gray-700">Expert IT advice and strategies to optimize your technology infrastructure.</p>
            <a href="{{ route('services.it-consulting') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- Cloud Computing -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Cloud Computing</h2>
            <p class="text-gray-700">Scalable and secure cloud solutions for businesses of all sizes.</p>
            <a href="{{ route('services.cloud-computing') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- Cybersecurity -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Cybersecurity</h2>
            <p class="text-gray-700">Protect your business from cyber threats with our advanced security solutions.</p>
            <a href="{{ route('services.cybersecurity') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- Smart Home Automation -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Smart Home Automation</h2>
            <p class="text-gray-700">Upgrade your home with smart technology for enhanced security and convenience.</p>
            <a href="{{ route('services.smart-home-automation') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>

        <!-- Network Installations -->
        <div class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold mb-2 text-gray-500">Network Installations</h2>
            <p class="text-gray-700">Professional network setup and installation for businesses and homes.</p>
            <a href="{{ route('services.network-installations') }}" class="text-blue-600 hover:underline mt-2 inline-block">Learn More →</a>
        </div>
    </div>
</section>
@endsection
