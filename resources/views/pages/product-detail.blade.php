@extends('layouts.app')

@section('title', $product->product_name . ' - PetMart')

@section('content')
<!-- Success Notification for Add to Cart -->
<div id="addToCartNotification" class="hidden fixed top-24 right-8 z-50 transform translate-x-full transition-transform duration-300">
    <div class="bg-white rounded-xl shadow-2xl p-6 flex items-center gap-4 border-l-4 border-green-500 min-w-[320px]">
        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-gray-900">Added to Cart!</p>
            <p class="text-sm text-gray-600">Product added successfully</p>
        </div>
        <div class="flex-shrink-0">
            <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
    </div>
</div>

<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-4 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-sm mb-6 flex-wrap">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-700 transition">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('shop') }}" class="text-gray-500 hover:text-blue-700 transition">Shop</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-gray-900 font-medium">{{ $product->product_name }}</span>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Product Image Section -->
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 p-6 sm:p-8 lg:p-12">
                    <div class="aspect-square bg-white rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ $product->getImageAssetUrl() }}" 
                             alt="{{ $product->product_name }}" 
                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" 
                             onerror="this.src='{{ asset('images/Petmart.png') }}'">
                    </div>
                    
                    <!-- Floating Badges -->
                    <div class="absolute top-10 left-10 flex flex-col gap-2">
                        <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">
                            {{ $product->pet_type }}
                        </span>
                        <span class="bg-white/90 backdrop-blur-sm text-blue-700 text-xs font-bold px-4 py-2 rounded-full shadow-md border border-blue-100">
                            {{ $product->accessories_type }}
                        </span>
                    </div>

                    <!-- Stock Badge -->
                    <div class="absolute bottom-10 right-10">
                        <span class="bg-green-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            In Stock
                        </span>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="flex flex-col p-6 sm:p-8 lg:p-12">
                    <!-- Product Header -->
                    <div class="flex-1">
                        <!-- Product Name -->
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                            {{ $product->product_name }}
                        </h1>

                        <!-- Rating & Reviews -->
                        <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex text-amber-400">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-lg font-bold text-gray-900">4.5</span>
                            <span class="text-sm text-gray-500">•</span>
                            <a href="#reviews" class="text-sm text-blue-700 hover:underline font-medium">128 reviews</a>
                        </div>

                        <!-- Price -->
                        <div class="mb-8">
                            <div class="flex items-baseline gap-3">
                                <span class="text-5xl font-extrabold bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">
                                    Rs. {{ number_format((float)$product->price, 2) }}
                                </span>
                                <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">Free Shipping</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Tax included</p>
                        </div>

                        <!-- Key Features -->
                        <div class="mb-8">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Product Highlights</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700">Premium quality for {{ $product->pet_type }}s</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700">Safe and tested materials</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700">Fast delivery across Sri Lanka</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Action Section -->
                    <div class="space-y-4 mt-auto pt-6 border-t border-gray-200">
                        @auth
                            @if(!Auth::user()->isAdmin())
                            <div class="space-y-4">
                                <!-- Quantity Selector -->
                                <div class="flex items-center gap-4">
                                    <label for="quantity" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Quantity:</label>
                                    <div class="flex items-center border-2 border-gray-300 rounded-xl overflow-hidden hover:border-blue-500 transition">
                                        <button type="button" id="decrease-qty" class="px-4 py-3 text-gray-700 hover:bg-blue-50 transition disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" 
                                               class="w-20 text-center border-0 focus:ring-0 focus:outline-none text-lg font-bold bg-transparent">
                                        <button type="button" id="increase-qty" class="px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Add to Cart & Buy Now Buttons -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <button type="button" id="add-to-cart-btn" 
                                        class="w-full bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-50 px-8 py-4 rounded-xl font-bold text-lg shadow-sm hover:shadow-md transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        Add to Cart
                                    </button>

                                    <form action="{{ route('cart.buy-now') }}" method="POST" id="buy-now-form">
                                        @csrf
                                        <input type="hidden" name="pet_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" id="buy-now-quantity" value="1">
                                        <button type="submit" 
                                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                                            Buy Now
                                        </button>
                                    </form>
                                </div>

                                <!-- Additional Info -->
                                <div class="flex items-center justify-center gap-6 text-sm text-gray-600 pt-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>Secure Payment</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        <span>Money Back Guarantee</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 text-center">
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
                
                // Sync with Buy Now form
                const buyNowQty = document.getElementById('buy-now-quantity');
                if (buyNowQty) buyNowQty.value = value;
            });
            
            // Also sync on button clicks
            decreaseBtn.addEventListener('click', () => {
                const buyNowQty = document.getElementById('buy-now-quantity');
                if (buyNowQty) buyNowQty.value = quantityInput.value;
            });
            increaseBtn.addEventListener('click', () => {
                const buyNowQty = document.getElementById('buy-now-quantity');
                if (buyNowQty) buyNowQty.value = quantityInput.value;
            });

            // Show success notification
            function showAddToCartNotification() {
                const notification = document.getElementById('addToCartNotification');
                
                notification.classList.remove('hidden');
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                    notification.classList.add('translate-x-0');
                }, 10);
                
                setTimeout(() => {
                    notification.classList.remove('translate-x-0');
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        notification.classList.add('hidden');
                    }, 300);
                }, 3000);
            }

            function updateCartCount() {
                const cartCountEl = document.querySelector('[data-cart-count]');
                if (cartCountEl) {
                    const currentCount = parseInt(cartCountEl.textContent) || 0;
                    cartCountEl.textContent = currentCount + 1;
                }
            }

            // Add to cart via AJAX
            addToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const quantity = parseInt(quantityInput.value);
                const formData = new FormData();
                formData.append('pet_id', productId);
                formData.append('quantity', quantity);
                formData.append('_token', '{{ csrf_token() }}');

                addToCartBtn.disabled = true;
                addToCartBtn.textContent = 'Adding...';
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
                        showAddToCartNotification();
                        updateCartCount();
                    } else {
                        throw new Error(data.message || 'Failed to add to cart');
                    }
                })
                .catch(error => {
                    alert(error.message || 'An error occurred. Please try again.');
                })
                .finally(() => {
                    addToCartBtn.disabled = false;
                    addToCartBtn.textContent = 'Add to Cart';
                    addToCartBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                });
            });
        });
    </script>
    @endif
@endauth
@endsection
