@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Cloud Computing Services</h1>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            Cloud computing services enable businesses to leverage scalable and secure solutions for their operations. We help you transition to the cloud and maximize its potential for your organization.
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-white">Cloud Migration and Implementation</h2>
                <p class="text-white mt-2">
                    Transition your business to the cloud seamlessly with our expert migration services, ensuring minimal disruption to your operations.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Cloud Infrastructure Management</h2>
                <p class="text-white mt-2">
                    We manage and optimize your cloud infrastructure, ensuring high availability, performance, and cost-efficiency.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Cloud Storage and Backup Solutions</h2>
                <p class="text-white mt-2">
                    Store your data securely with our cloud-based storage solutions, coupled with reliable backup systems for disaster recovery.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Cloud Application Development</h2>
                <p class="text-white mt-2">
                    Develop and deploy cloud-based applications that are scalable, flexible, and tailored to your business needs.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Cloud Security and Compliance</h2>
                <p class="text-white mt-2">
                    Ensure your cloud environment is secure and compliant with industry regulations through our comprehensive cloud security services.
                </p>
            </div>
        </div>
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
