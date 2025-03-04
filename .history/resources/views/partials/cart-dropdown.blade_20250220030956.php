@foreach($cartItems as $item)
    @php
        $images = json_decode($item->product->product_image, true);
        $firstImage = is_array($images) && count($images) > 0 ? $images[0] : 'default-image.jpg';
    @endphp

    <div class="cart-item flex items-center space-x-4 p-2 border-b">
        <img src="{{ asset($firstImage) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">

        <div class="flex-1">
            <p class="text-sm font-semibold">{{ $item->product->name }}</p>
            <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
            <p class="text-xs font-bold">KSh {{ number_format($item->subtotal, 2) }}</p>
        </div>

        <button class="text-red-500 remove-item" data-id="{{ $item->id }}">
            &times;
        </button>
    </div>
@endforeach
