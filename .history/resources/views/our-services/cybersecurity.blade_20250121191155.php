@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Cybersecurity Services</h1>
        <p class="text-lg text-gray-700 leading-relaxed mb-6">
            In an era of escalating cyber threats, safeguarding your business is crucial. Our cybersecurity services are designed to provide robust protection, ensuring the integrity and security of your data and systems.
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Vulnerability Assessments and Penetration Testing</h2>
                <p class="text-gray-700 mt-2">
                    We identify weak points in your IT infrastructure and simulate attacks to evaluate your defenses, ensuring vulnerabilities are addressed before malicious actors exploit them.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Security Audits and Compliance Checks</h2>
                <p class="text-gray-700 mt-2">
                    Our experts conduct thorough audits to ensure your business complies with regulatory standards and industry best practices, reducing the risk of penalties and breaches.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Firewall Management and Intrusion Detection</h2>
                <p class="text-gray-700 mt-2">
                    We deploy and manage advanced firewalls and intrusion detection systems to monitor and block unauthorized access to your network, keeping your systems secure.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Data Encryption and Protection</h2>
                <p class="text-gray-700 mt-2">
                    Safeguard sensitive data with state-of-the-art encryption solutions that protect it from unauthorized access, both in transit and at rest.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Security Awareness Training</h2>
                <p class="text-gray-700 mt-2">
                    Equip your employees with the knowledge to identify and prevent cyber threats through tailored security awareness training programs.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Incident Response and Recovery</h2>
                <p class="text-gray-700 mt-2">
                    In the event of a breach, our incident response team takes swift action to mitigate damage and restore normal operations as quickly as possible.
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
