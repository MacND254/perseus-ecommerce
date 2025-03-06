@extends('layouts.app')

@section('content')
    <!-- Image Section Below Navigation Menu -->
    <div class="w-full h-72">
        <img src="{{ asset('images/about-us.png') }}" alt="About Us Banner" class="w-full h-full object-cover">
    </div>

    <div class="container mx-auto px-4">
        <!-- About Us Section -->
        <div class="text-center my-12">
            <h1 class="text-4xl font-bold text-gray-500">About Us</h1>
            <p class="text-white mt-4">
                Welcome to our website! We are passionate about delivering quality content and services to our community.
            </p>
        </div>

        <!-- Our Story -->
        <div class="my-12">
            <h2 class="text-3xl font-semibold text-gray-500">Our Story</h2>
            <p class="mt-4 ttext-white leading-relaxed">
                Our journey began with a mission to create something unique and impactful. Over the years, we have grown
                into a team of dedicated professionals who share a common vision: to innovate and inspire.
            </p>
        </div>

        <!-- Our Mission -->
        <div class="my-12">
            <h2 class="text-3xl font-semibold text-gray-500">Our Mission</h2>
            <p class="mt-4 ttext-white leading-relaxed">
                To deliver exceptional value to our audience by providing high-quality content, products, and services
                that exceed expectations.
            </p>
        </div>

        <!-- Our Qualities -->
        <section class="qualities-section my-12">
            <h2 class="text-3xl font-semibold text-white text-center">Our Qualities</h2>
            <div class="qualities-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-6">
                <div class="quality-item text-center">
                    <img src="{{ asset('images/customer-service.png') }}" alt="Quality 1" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Customer Support</div>
                </div>
                <div class="quality-item text-center">
                    <img src="{{ asset('images/scalable.png') }}" alt="Quality 2" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Scalability</div>
                </div>
                <div class="quality-item text-center">
                    <img src="{{ asset('images/dependable.png') }}" alt="Quality 3" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Reliability</div>
                </div>
                <div class="quality-item text-center">
                    <img src="{{ asset('images/teamwork.png') }}" alt="Quality 4" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Team Work</div>
                </div>
                <div class="quality-item text-center">
                    <img src="{{ asset('images/quality.png') }}" alt="Quality 5" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Quality Assurance</div>
                </div>
                <div class="quality-item text-center">
                    <img src="{{ asset('images/innovation.png') }}" alt="Quality 6" class="quality-icon mx-auto mb-4 w-16 h-16">
                    <div class="quality-label font-medium">Innovation</div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('footer')
    <footer class="bg-gray-800 text-white mt-16 py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
            <nav class="mt-2">
                <a href="{{ route('about-us.index') }}" class="text-gray-400 hover:text-white">About Us</a> |
                <a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Blog</a> |
                <a href="{{ route('contact-us.index') }}" class="text-gray-400 hover:text-white">Contact Us</a>
            </nav>
        </div>
    </footer>
@endsection
