<div class="bg-gray-50 p-6 rounded-lg min-h-[50vh]">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h2>

    @if(count($cartItems) === 0)
        <div class="text-center py-12 bg-white rounded-lg shadow">
            <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <p class="text-xl text-gray-600 mb-4">Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div wire:key="cart-item-{{ $item['item_id'] }}" class="bg-white rounded-lg shadow-sm p-4 flex flex-col sm:flex-row items-center gap-4 hover:shadow-md transition-shadow">
                        <!-- Image -->
                        <div class="w-24 h-24 flex-shrink-0">
                             <img src="{{ Str::startsWith($item['image_url'], ['http', '/']) ? $item['image_url'] : asset($item['image_url']) }}" 
                                 alt="{{ $item['product_name'] }}" 
                                 class="w-full h-full object-cover rounded-lg"
                                 onerror="this.src='{{ asset('images/Petmart.png') }}'">
                        </div>
                        
                        <!-- Details -->
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $item['product_name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $item['pet_type'] }} - {{ $item['accessories_type'] }}</p>
                            <p class="text-cyan-600 font-bold mt-1">Rs. {{ number_format($item['price'], 2) }}</p>
                        </div>

                        <!-- Quantity -->
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button wire:click="updateQuantity({{ $item['item_id'] }}, -1)" class="px-3 py-1 hover:bg-gray-100 text-gray-600 font-bold">-</button>
                            <span class="px-3 py-1 border-l border-r border-gray-300 font-bold w-12 text-center text-blue-700 bg-gray-50">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity({{ $item['item_id'] }}, 1)" class="px-3 py-1 hover:bg-gray-100 text-gray-600 font-bold">+</button>
                        </div>

                        <!-- Subtotal & Remove -->
                        <div class="flex flex-col items-end gap-2 w-full sm:w-auto">
                            <span class="font-bold text-gray-800">Rs. {{ number_format($item['subtotal'], 2) }}</span>
                            <button wire:click="removeItem({{ $item['item_id'] }})" class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-all duration-200" title="Remove Item">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach

                <!-- Global Loading Indicator -->
                <div wire:loading class="fixed bottom-10 left-10 z-50">
                    <div class="bg-blue-600 text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="font-bold">Updating Cart...</span>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h3>
                    
                    <div class="space-y-4 text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-medium">Rs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax (8%)</span>
                            <span class="font-medium">Rs. {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between text-lg font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-cyan-600">Rs. {{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('shop') }}" class="block w-full text-center border border-gray-300 rounded-lg py-3 text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                            Continue Shopping
                        </a>
                        
                        <form action="{{ route('stripe.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg py-3 font-semibold shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all">
                                Checkout with Stripe
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 flex items-center justify-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Secure Checkout
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
