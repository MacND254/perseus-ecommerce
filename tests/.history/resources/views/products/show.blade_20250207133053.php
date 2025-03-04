@extends('layouts.app')

@section('title', $product->name . ' | Perseus eCommerce')

@section('content')
<section class="container mx-auto py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Product Images -->
        <div class="col-span-1">
            @php
                $images = json_decode($product->product_image, true) ?? [];
            @endphp

            @if (!empty($images))
                <div class="relative">
                    <img id="mainImage" src="{{ asset('storage/' . $images[0]) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-auto rounded-lg shadow-lg object-contain cursor-pointer transition-transform duration-300 hover:scale-105">
                </div>

                <!-- Thumbnail Navigation -->
                <div class="flex space-x-2 mt-4">
                    @foreach($images as $image)
                        <img src="{{ asset('storage/' . $image) }}"
                            alt="Thumbnail"
                            class="w-16 h-16 rounded-lg shadow-md cursor-pointer hover:opacity-80 border transition-transform duration-300 hover:scale-110"
                            onclick="document.getElementById('mainImage').src = '{{ asset('storage/' . $image) }}'">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No images available for this product.</p>
            @endif
        </div>

        <!-- Middle Column: Product Details -->
        <div class="col-span-1">
            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-green-500 font-bold text-2xl mb-2">Ksh. {{ number_format($product->price) }}</p>

            @if($product->discount_price)
                <p class="text-red-500 font-semibold text-lg">
                    Discounted Price: Ksh. {{ number_format($product->discount_price) }}
                </p>
            @endif

            <ul class="list-disc list-inside text-gray-700 my-4">
                @foreach(explode("\n", $product->description) as $point)
                    <li>{{ $point }}</li>
                @endforeach
            </ul>

          <!-- Add to Cart Form -->
          <form id="addToCartForm">
            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <select id="size" name="size">
                {{-- Options for sizes --}}
            </select>
            <select id="color" name="color">
                {{-- Options for colors --}}
            </select>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 mt-4">
                Add to Cart
            </button>
        </form>

        <p id="cartMessage" class="text-green-500 font-semibold mt-2 hidden"></p>

        <script>
        document.getElementById('addToCartForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let productId = document.getElementById('product_id').value;
            let quantity = document.getElementById('quantity').value;
            let size = document.getElementById('size').value;
            let color = document.getElementById('color').value;

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity, size: size, color: color })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('cartMessage').textContent = data.message;
                document.getElementById('cartMessage').classList.remove('hidden');
                document.getElementById('cart-count').innerText = data.cart_count; // Update cart count
                document.getElementById('cart-dropdown').innerHTML = data.cart_html; // Update cart dropdown
            })
            .catch(error => console.error('Error:', error));
        });

        </script>



            <!-- Social Sharing Buttons -->
            <div class="mt-4">
                <p class="font-semibold">Share this product:</p>
                <div class="flex space-x-3 mt-2">
                    <a href="#" class="bg-blue-500 text-white px-3 py-1 rounded">Facebook</a>
                    <a href="#" class="bg-blue-400 text-white px-3 py-1 rounded">Twitter</a>
                    <a href="#" class="bg-red-500 text-white px-3 py-1 rounded">Pinterest</a>
                </div>
            </div>
        </div>

        <!-- Right Column: Delivery, Shipping Info & Reviews -->
        <div class="col-span-1">
            <!-- Logged-in User's Delivery Address -->
            <div class="p-4 bg-gray-100 rounded-lg shadow-md mb-6">
                <h2 class="text-lg font-bold mb-2">Delivery Address</h2>
                <p>{{ Auth::user()->address ?? 'No address provided' }}</p>
            </div>

            <!-- Shipping Information -->
            <div class="p-4 bg-gray-100 rounded-lg shadow-md mb-6">
                <h2 class="text-lg font-bold mb-2">Shipping Information</h2>
                <p>Estimated delivery within 3-5 business days.</p>
                <p>Free shipping on orders above Ksh. 5000.</p>
            </div>

            <!-- Customer Reviews -->
            <h2 class="text-lg font-bold mt-6">Customer Reviews</h2>
            <div class="space-y-4 mt-4">
                @forelse($product->reviews as $review)
                    <div class="p-4 bg-gray-100 rounded shadow">
                        <p class="font-bold">{{ $review->user->name ?? 'Anonymous' }}</p>
                        <p>{{ $review->content }}</p>
                        <p class="text-yellow-500">Rating: {{ $review->rating }} / 5</p>
                    </div>
                @empty
                    <p>No reviews yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Full Product Details Below -->
    <div class="mt-12">
        <h2 class="text-xl font-bold">Full Product Details</h2>
        <p class="text-gray-700 mt-2">{{ $product->full_description }}</p>
    </div>

    <!-- Related Products -->
    <h2 class="text-xl font-bold mt-8">Related Products</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">
        @foreach($relatedProducts as $related)
            <a href="{{ route('products.show', $related->id) }}" class="bg-white p-4 rounded shadow-md transition hover:shadow-lg hover:scale-105">
                <img src="{{ asset('storage/' . json_decode($related->product_image, true)[0] ?? 'default.jpg') }}"
                     alt="{{ $related->name }}" class="w-full h-40 object-contain rounded">
                <p class="text-center mt-2 font-semibold">{{ $related->name }}</p>
            </a>
        @endforeach
    </div>
</section>
@endsection
