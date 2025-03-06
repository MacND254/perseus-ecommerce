@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">All Network Installations</h1>
        <p class="text-lg text-white leading-relaxed mb-6">
            From structured cabling to advanced security systems, we offer comprehensive network installation services to meet your connectivity and security needs.
        </p>

        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-500">Structured Cabling</h2>
            <p class="text-white mt-2">
                Design and implement robust cabling systems that support your communication and data needs efficiently.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">VoIP Installation</h2>
            <p class="text-white mt-2">
                Enhance your communication capabilities with state-of-the-art VoIP systems tailored to your business.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">CCTV Installations</h2>
            <p class="text-white mt-2">
                Monitor and protect your premises with advanced CCTV systems designed for optimal security coverage.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">Office Access Points Installation</h2>
            <p class="text-white mt-2">
                Ensure seamless connectivity throughout your workspace with strategically placed access points.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">Biometrics</h2>
            <p class="text-white mt-2">
                Enhance security and streamline access control with biometric systems tailored to your requirements.
            </p>
        </div>
    </div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection
