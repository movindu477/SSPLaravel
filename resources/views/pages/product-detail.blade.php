@extends('layouts.app')

@section('title', $product->product_name . ' - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('shop') }}" class="inline-flex items-center text-blue-700 hover:text-blue-800 mb-6 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Shop
        </a>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-10">
                <!-- Product Image -->
                <div class="relative">
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ $product->getImageAssetUrl() }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                    </div>
                    <div class="absolute top-4 left-4 bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-full">
                        {{ $product->pet_type }}
                    </div>
                </div>

                <!-- Product Details -->
                <div class="flex flex-col justify-between">
                    <div>
                        <!-- Category Badge -->
                        <div class="mb-4">
                            <span class="inline-block bg-blue-50 text-blue-700 text-sm font-semibold px-3 py-1.5 rounded-md">
                                {{ $product->accessories_type }}
                            </span>
                        </div>

                        <!-- Product Name -->
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                            {{ $product->product_name }}
                        </h1>

                        <!-- Rating -->
                        <div class="flex items-center gap-2 mb-6">
                            <div class="flex text-yellow-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-lg text-gray-700 font-medium">4.5</span>
                            <span class="text-sm text-gray-500">(128 reviews)</span>
                        </div>

                        <!-- Price -->
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-blue-700">
                                Rs. {{ number_format((float)$product->price, 2) }}
                            </span>
                        </div>

                        <!-- Product Info -->
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Details</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <span class="text-gray-600 font-medium w-32">Pet Type:</span>
                                    <span class="text-gray-900">{{ $product->pet_type }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 font-medium w-32">Category:</span>
                                    <span class="text-gray-900">{{ $product->accessories_type }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 font-medium w-32">Price:</span>
                                    <span class="text-gray-900 font-semibold">Rs. {{ number_format((float)$product->price, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-6 space-y-4">
                        @auth
                            @if(!Auth::user()->isAdmin())
                            <div class="space-y-4">
                                <!-- Quantity Selector -->
                                <div class="flex items-center gap-4">
                                    <label for="quantity" class="text-gray-700 font-medium">Quantity:</label>
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button type="button" id="decrease-qty" class="px-4 py-2 text-gray-700 hover:bg-gray-100 transition" disabled>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" class="w-20 text-center border-0 focus:ring-0 focus:outline-none text-lg font-semibold">
                                        <button type="button" id="increase-qty" class="px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Add to Cart Button -->
                                <button type="button" id="add-to-cart-btn" 
                                    class="w-full bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                                    Add to Cart
                                </button>
                                
                                <div id="cart-message" class="hidden text-sm font-medium"></div>
                            </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold text-center transition duration-150">
                                Login to Add to Cart
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
    @if(!Auth::user()->isAdmin())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');
            const addToCartBtn = document.getElementById('add-to-cart-btn');
            const cartMessage = document.getElementById('cart-message');
            const productId = {{ $product->id }};
            let currentQuantity = parseInt(quantityInput.value);

            // Quantity controls
            decreaseBtn.addEventListener('click', function() {
                if (currentQuantity > 1) {
                    currentQuantity--;
                    quantityInput.value = currentQuantity;
                    decreaseBtn.disabled = currentQuantity <= 1;
                }
            });

            increaseBtn.addEventListener('click', function() {
                if (currentQuantity < 99) {
                    currentQuantity++;
                    quantityInput.value = currentQuantity;
                    decreaseBtn.disabled = false;
                }
            });

            quantityInput.addEventListener('change', function() {
                let value = parseInt(this.value);
                if (isNaN(value) || value < 1) {
                    value = 1;
                } else if (value > 99) {
                    value = 99;
                }
                currentQuantity = value;
                this.value = value;
                decreaseBtn.disabled = value <= 1;
            });

            // Add to cart via AJAX
            addToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const quantity = parseInt(quantityInput.value);
                const formData = new FormData();
                formData.append('pet_id', productId);
                formData.append('quantity', quantity);
                formData.append('_token', '{{ csrf_token() }}');

                addToCartBtn.disabled = true;
                addToCartBtn.classList.add('opacity-75', 'cursor-not-allowed');

                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success || data.message) {
                        cartMessage.textContent = data.message || 'Added to cart successfully!';
                        cartMessage.classList.remove('hidden', 'text-red-600');
                        cartMessage.classList.add('text-green-600');
                    } else {
                        throw new Error(data.message || 'Failed to add to cart');
                    }
                })
                .catch(error => {
                    cartMessage.textContent = error.message || 'An error occurred. Please try again.';
                    cartMessage.classList.remove('hidden', 'text-green-600');
                    cartMessage.classList.add('text-red-600');
                })
                .finally(() => {
                    addToCartBtn.disabled = false;
                    addToCartBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    
                    setTimeout(() => {
                        cartMessage.classList.add('hidden');
                    }, 3000);
                });
            });
        });
    </script>
    @endif
@endauth
@endsection
