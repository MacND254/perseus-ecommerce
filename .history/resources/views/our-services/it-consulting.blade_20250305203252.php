@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">IT Consulting</h1>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            Navigate the complexities of technology with our expert IT consulting services. We provide insights and strategies that align with your business objectives.
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-500">IT Strategy Development</h2>
                <p class="text-white mt-2">
                    Plan and execute IT strategies that drive growth and innovation while staying aligned with your business goals.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Technology Assessments and Recommendations</h2>
                <p class="text-white mt-2">
                    Evaluate your current technology stack and receive expert recommendations to optimize your infrastructure.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">IT Project Management</h2>
                <p class="text-white mt-2">
                    Successfully plan, execute, and deliver IT projects on time and within budget with our expert project management services.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Digital Transformation Consulting</h2>
                <p class="text-white mt-2">
                    Embrace digital transformation with strategic guidance to modernize your processes and technologies.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Data Analytics and Business Intelligence</h2>
                <p class="text-white mt-2">
                    Harness the power of data with advanced analytics and business intelligence solutions to make informed decisions.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('includes.footer')
@endsection
