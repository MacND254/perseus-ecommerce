@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative bg-center bg-no-repeat bg-cover overflow-hidden h-[70vh]">

    <div class="pt-[calc(640/1366*100%)]"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center">
        <div class="text-center text-white px-4 sm:px-8 md:px-10 max-w-2xl mx-auto">
            <!-- Responsive Text -->
            <h1 class="text-lg sm:text-xl md:text-3xl lg:text-5xl font-bold leading-tight">
                Home of Information Technology and Innovation
            </h1>
            <!-- Responsive Button -->
            <a href="{{ route('products.index') }}"
               class="mt-6 inline-block px-3 py-2 sm:px-4 sm:py-2 md:px-6 md:py-3 lg:px-8 lg:py-4 rounded-md font-semibold text-sm sm:text-base md:text-lg lg:text-xl relative overflow-hidden transition-all duration-300 ease-in-out bg-gradient-to-r from-purple-700 to-purple-500 text-white shadow-lg hover:from-purple-500 hover:to-purple-700 hover:shadow-2xl">
                Shop Now
            </a>

        </div>
        <div class="small-text text-red-600 sm:text-x2 md:text-1xl lg:text-2xl font-bold leading-tight mt-[70px]">
            LOOKING FOR OUR SERVICES? <a href="{{ route('services.index') }}" class="text-green-600 font-bold">CLICK HERE</a>
        </div>

    </div>
    <div class="text-white text-1xl mt-8 color-transition text-center">
        The Future is Here With Us
    </div>
</section>

<!-- Image Slider Section -->
<section class="py-12 bg-gray-500">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-black text-center">Featured Products</h2>
        <div class="relative flex justify-center items-center">
            <!-- Slider Container -->
            <div class="w-[90vw] max-w-[800px] h-[calc(90vw/2.285)] max-h-[350px] overflow-hidden rounded-lg">
                <div class="flex transition-transform duration-1000 ease-in-out" id="slider">
                    <div class="flex-none w-full h-full">
                        <img src="{{ asset('images/carousel7.jpg') }}" class="w-full h-full object-contain" alt="Product 7">
                    </div>
                    @for ($i = 1; $i <= 7; $i++)
                        <div class="flex-none w-full h-full">
                            <img src="{{ asset("images/carousel$i.jpg") }}" class="w-full h-full object-contain" alt="Product {{ $i }}">
                        </div>
                    @endfor
                    <div class="flex-none w-full h-full">
                        <img src="{{ asset('images/carousel1.jpg') }}" class="w-full h-full object-contain" alt="Product 1">
                    </div>
                </div>
            </div>
            <!-- Slider Navigation -->
            <button class="absolute left-4 top-1/2 -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full z-10 hover:bg-gray-700" id="prevBtn" aria-label="Previous Slide">
                &#8249;
            </button>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-full z-10 hover:bg-gray-700" id="nextBtn" aria-label="Next Slide">
                &#8250;
            </button>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-12 bg-grey-500">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-white text-center">Explore Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <a href="#" class="bg-white shadow-md text-black rounded p-4 text-center hover:bg-green-100 transition">Electronics</a>
            <a href="#" class="bg-white shadow-md text-black rounded p-4 text-center hover:bg-green-100 transition">Clothing</a>
            <a href="#" class="bg-white shadow-md text-black rounded p-4 text-center hover:bg-green-100 transition">Accessories</a>
            <a href="#" class="bg-white shadow-md text-black rounded p-4 text-center hover:bg-green-100 transition">Home Appliances</a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6  text-center">Trending Products</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($products->take(8) as $product)
            <a href="{{ route('products.show', $product->id) }}" class="group relative bg-white text-black rounded-lg shadow-md transition duration-300 hover:shadow-[0_0_15px_rgba(0,0,255,0.6)] flex flex-col items-center justify-between p-4 overflow-hidden hover:scale-105 cursor-pointer">
                @php
                    $imageUrls = json_decode($product->product_image, true);
                    $firstImageUrl = $imageUrls[0] ?? 'images/default-placeholder.png';
                @endphp
                <div class="w-full h-40 flex items-center justify-center overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $firstImageUrl) }}" alt="{{ $product->name }}" class="object-contain h-full w-full text-black transition-transform duration-300 group-hover:scale-110">
                </div>
                <h3 class="text-lg font-bold mt-4 text-black">{{ $product->name }}</h3>
                <p class="text-green-500 font-semibold mt-2">Ksh.{{ number_format($product->price) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Slider JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slider = document.getElementById("slider");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        let index = 1;
        const slideWidth = slider.children[0].offsetWidth;
        const totalSlides = slider.children.length - 2;
        const transitionTime = 1000;
        const delayTime = 5000;

        function updateSlider() {
            slider.style.transition = `transform ${transitionTime}ms ease-in-out`;
            slider.style.transform = `translateX(-${index * 100}%)`;
        }

        function nextSlide() {
            index++;
            updateSlider();
            if (index === totalSlides + 1) {
                setTimeout(() => {
                    slider.style.transition = "none";
                    index = 1;
                    slider.style.transform = `translateX(-${index * 100}%)`;
                }, transitionTime);
            }
        }

        function prevSlide() {
            index--;
            updateSlider();
            if (index === 0) {
                setTimeout(() => {
                    slider.style.transition = "none";
                    index = totalSlides;
                    slider.style.transform = `translateX(-${index * 100}%)`;
                }, transitionTime);
            }
        }

        let autoSlide = setInterval(nextSlide, delayTime);
        nextBtn.addEventListener("click", () => { clearInterval(autoSlide); nextSlide(); autoSlide = setInterval(nextSlide, delayTime); });
        prevBtn.addEventListener("click", () => { clearInterval(autoSlide); prevSlide(); autoSlide = setInterval(nextSlide, delayTime); });
    });
</script>
@endsection
