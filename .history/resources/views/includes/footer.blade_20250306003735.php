<footer class="relative bg-cover bg-center text-white py-12 justify-center" style="background-image: url('{{ asset('images/footer3-bg.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Company Description Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">Perseus Enterprise</h3>
                <p class="leading-relaxed">
                    Looking to remodel an existing infrastructure? </br>Perseus Networks and Technologies designs and installs </br>versatile, expandable, integrated, and cost-effective </br>systems to fit your company's growing needs.
                </p>
                <div class="space-x-4">
                    <ul>
                   <li> <a href="#" class="text-gray-400 hover:text-white">FACEBOOK<i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">X<i class="fab fa-twitter"></i></a></li>
                   <li> <a href="#" class="text-gray-400 hover:text-white">INSTAGRAM<i class="fab fa-instagram"></i></a></li>
                     <li> <a href="#" class="text-gray-400 hover:text-white">LINKEDIN<i class="fab fa-linkedin-in"></i></a></li>
                   </ul>
                </div>
            </div>

            <!-- Contact Info Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">CONTACT INFO</h3>
                <p class="mb-2"><strong>Address:</strong><br> Gaze Plaza, </br> 6th Floor Office 52, </br> Latema Rd, </br> Nairobi-Kenya</p>
                <p class="mb-2"><strong>Call / Whatsapp:</strong><br> +254 715 399 369</p>
                <p><strong>Email:</strong><br> m.perseus.enterprise@gmail.com</p>
            </div>

            <!-- Useful Links Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">USEFUL LINKS</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Home</a></li>
                 <!--   <li><a href="{{ route('about-us.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">About Us</a></li> -->
                    <li> <a href="{{ route('services.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Our Services</a></li>
                    <li> <a href="{{ route('career.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Career</a></li>
                    <li>  <a href="{{ route('blog.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Blog</a></li>
                    <li> <a href="{{ route('products.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Shop</a></li>
                 <!--   <li>  <a href="{{ route('contact-us.index') }}" class="py-2 block border-b border-gray-700 hover:bg-gray-700">Contact Us</a></li> -->
                </ul>
            </div>
        </div>

        <!-- Social Media and Copyright -->
        <div class="mt-8 pt-4 border-t border-gray-700 flex flex-wrap justify-between items-center">
            <p class="text-sm">&copy; {{ date('Y') }} Perseus Networks & Technologies | All Rights Reserved</p>
            <div class="space-x-4">
                <a href="#" class="text-gray-400 hover:text-white">FACEBOOK<i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-400 hover:text-white">X<i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-400 hover:text-white">INSTAGRAM<i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-white">LINKEDIN<i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</footer>
