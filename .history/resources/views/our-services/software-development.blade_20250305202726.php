@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Software Development</h1>
        <p class="text-lg text-white leading-relaxed mb-6">
            At the heart of business innovation lies software development. We provide custom solutions tailored to your specific needs, driving efficiency and improving customer experiences.
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Web Application Development</h2>
                <p class="text-white mt-2">
                    Build responsive and feature-rich web applications that enhance your online presence and serve your customers better.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Mobile App Development</h2>
                <p class="text-white mt-2">
                    Create user-friendly mobile apps for iOS and Android platforms that align with your business goals and engage your audience.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Desktop Software Development</h2>
                <p class="text-white mt-2">
                    Develop robust desktop applications tailored to your operational needs, ensuring optimal performance and reliability.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">API Development and Integration</h2>
                <p class="text-white mt-2">
                    Seamlessly integrate your systems with powerful APIs to improve functionality and enhance interoperability across platforms.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Software Testing and Quality Assurance</h2>
                <p class="text-white mt-2">
                    Ensure your software is free from bugs and performs flawlessly with our comprehensive testing and quality assurance services.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection
