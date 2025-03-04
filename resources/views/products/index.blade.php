@extends('layouts.app')

@section('title', 'Products | Perseus eCommerce')

@section('content')
<section class="container mx-auto py-12">


    <!-- Shop by Category Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-center mb-4">Shop by Category</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @foreach($categories->take(6) as $category)
            <a href="javascript:void(0);" onclick="filterByCategory({{ $category->id }})" class="block">
                <div class="group bg-white rounded-lg shadow-md hover:shadow-[0_0_15px_rgba(0,0,255,0.6)] transition duration-300 cursor-pointer flex flex-col items-center p-4 hover:scale-105">
                    <div class="w-full h-32 md:h-40 flex items-center justify-center overflow-hidden rounded-lg">
                        <img src="{{ $category->category_image ? asset('storage/' . $category->category_image) : asset('images/default-placeholder.png') }}"
                            alt="{{ $category->name }}"
                            class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <h3 class="text-lg font-bold mt-2 text-center">{{ $category->name }}</h3>
                </div>
            </a>

            @endforeach
        </div>
    </div>

    <h1 class="text-3xl font-bold mb-6 text-center">Browse Products</h1>

    <!-- Filters -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <label for="category" class="mr-2 font-semibold">Category:</label>
            <select id="category" class="p-2 border rounded">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="sort" class="mr-2 font-semibold">Sort By:</label>
            <select id="sort" class="p-2 border rounded">
                <option value="">Popularity</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-6 gap-6">
        @foreach($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="group relative bg-white rounded-lg shadow-md transition duration-300 hover:shadow-[0_0_15px_rgba(0,0,255,0.6)] flex flex-col items-center justify-between p-4 overflow-hidden hover:scale-105 cursor-pointer">
                @php
                    $imageUrls = json_decode($product->product_image, true);
                    $firstImageUrl = $imageUrls[0] ?? 'images/default-placeholder.png';
                @endphp
                <div class="w-full h-40 flex items-center justify-center overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $firstImageUrl) }}" alt="{{ $product->name }}" class="object-contain h-full w-full transition-transform duration-300 group-hover:scale-110">
                </div>
                <h3 class="text-lg font-bold mt-4">{{ $product->name }}</h3>
                <p class="text-green-500 font-semibold mt-2">Ksh.{{ number_format($product->price) }}</p>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</section>

<script>
    // Update the products grid based on category and sort selection
    document.getElementById('category').addEventListener('change', updateProducts);
    document.getElementById('sort').addEventListener('change', updateProducts);

    function updateProducts() {
        const category = document.getElementById('category').value;
        const sort = document.getElementById('sort').value;
        const url = new URL(window.location.href);

        if (category) {
            url.searchParams.set('category', category);
        } else {
            url.searchParams.delete('category');
        }

        if (sort) {
            url.searchParams.set('sort', sort);
        } else {
            url.searchParams.delete('sort');
        }

        window.location.href = url;
    }

    // Function to filter by clicking category cards
    function filterByCategory(categoryId) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', categoryId);
        window.location.href = url;
    }
</script>
@endsection
