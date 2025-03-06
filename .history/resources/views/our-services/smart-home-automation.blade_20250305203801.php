@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Smart Home Automation</h1>
        <p class="text-lg text-white leading-relaxed mb-6">
            Transform your living space with cutting-edge smart home automation solutions that enhance comfort, security, and efficiency.
        </p>

        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-500">Seamless Device Integration</h2>
            <p class="text-white mt-2">
                Integrate all your smart devices into one cohesive ecosystem for effortless control and convenience.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">Energy Management</h2>
            <p class="text-white mt-2">
                Optimize energy usage with automated lighting, heating, and cooling systems to reduce your carbon footprint.
            </p>

            <h2 class="text-2xl font-semibold text-gray-500">Enhanced Home Security</h2>
            <p class="text-white mt-2">
                Secure your home with smart locks, surveillance cameras, and real-time alerts for complete peace of mind.
            </p>
        </div>
    </div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection
