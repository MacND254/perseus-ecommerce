@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-6">Managed IT Services</h1>
        <p class="text-lg text-white leading-relaxed mb-6">
            Our Managed IT Services offer comprehensive solutions to help businesses streamline their operations and ensure the seamless functioning of their IT infrastructure. Here's how we deliver excellence:
        </p>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Network Monitoring and Management</h2>
                <p class="text-white mt-2">
                    We monitor your network 24/7 to detect and resolve issues before they impact your operations. From optimizing bandwidth usage to troubleshooting connectivity issues, we ensure your network stays reliable and efficient.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Server Maintenance and Support</h2>
                <p class="text-white mt-2">
                    Our team ensures that your servers are always up-to-date, secure, and running smoothly. We perform routine checks, apply patches, and address hardware and software issues promptly to minimize downtime.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Help Desk Support for End-Users</h2>
                <p class="text-white mt-2">
                    We provide expert support for your employees, resolving technical issues efficiently. Our friendly help desk team is just a call away, ready to assist with software problems, password resets, and more.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Cybersecurity Protection</h2>
                <p class="text-white mt-2">
                    Protecting your business from cyber threats is our top priority. We implement firewalls, antivirus software, and intrusion detection systems to safeguard your data and ensure compliance with industry regulations.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Data Backup and Disaster Recovery</h2>
                <p class="text-white mt-2">
                    We ensure that your critical data is backed up regularly and can be quickly restored in the event of a disaster. Our disaster recovery solutions minimize data loss and downtime, keeping your business operational.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Cloud Services Management</h2>
                <p class="text-white mt-2">
                    From cloud migration to ongoing management, we help you leverage the full potential of cloud technology. Enjoy scalable and cost-effective solutions tailored to your business needs.
                </p>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-500">Regular System Updates and Patching</h2>
                <p class="text-white mt-2">
                    Stay ahead of vulnerabilities with our proactive approach to system updates. We apply patches and upgrades to keep your systems secure and performing at their best.
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
