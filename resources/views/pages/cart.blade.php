@extends('layouts.app')

@section('title', 'Shopping Cart - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Shopping Cart</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Cart Items</h2>
                        <span class="text-gray-600" id="cart-count">0 items</span>
                    </div>

                    <!-- Loading State -->
                    <div id="cart-loading" class="text-center py-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-700 border-t-transparent mx-auto"></div>
                        <p class="mt-4 text-gray-600">Loading cart...</p>
                    </div>

                    <!-- Empty State -->
                    <div id="cart-empty" class="hidden text-center py-12">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-xl text-gray-600 mb-4">Your cart is empty</p>
                        <a href="{{ route('shop') }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition">
                            Continue Shopping
                        </a>
                    </div>

                    <!-- Cart Items Container -->
                    <div id="cart-items" class="space-y-6 hidden"></div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('shop') }}" class="text-blue-700 hover:text-blue-800 font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="subtotal">Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax (8%)</span>
                            <span id="tax">Rs. 0.00</span>
                        </div>
                        <div class="pt-4 border-t border-gray-200 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-blue-700" id="total">Rs. 0.00</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Enter code" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('payment') }}" class="block w-full bg-blue-700 hover:bg-blue-800 text-white text-center py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-4">
                        Proceed to Checkout
                    </a>

                    <div class="flex items-center justify-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Secure checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const CART_TOKEN = "{{ session('user_token') }}";

// Helper function to format image URL
function getImageUrl(imageUrl) {
    if (!imageUrl || imageUrl.trim() === '') {
        return "{{ asset('images/Petmart.png') }}";
    }
    if (imageUrl.startsWith('http://') || imageUrl.startsWith('https://')) {
        return imageUrl;
    }
    if (imageUrl.startsWith('/')) {
        imageUrl = imageUrl.substring(1);
    }
    if (!imageUrl.startsWith('images/')) {
        imageUrl = 'images/' + imageUrl;
    }
    return "{{ asset('') }}" + imageUrl;
}

// Load cart items
async function loadCart() {
    const loadingEl = document.getElementById('cart-loading');
    const emptyEl = document.getElementById('cart-empty');
    const itemsEl = document.getElementById('cart-items');
    
    if (!CART_TOKEN) {
        loadingEl.classList.add('hidden');
        emptyEl.classList.remove('hidden');
        return;
    }

    // Get CSRF token for the request
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    try {
        const res = await fetch("/api/cart", {
            headers: {
                "Authorization": "Bearer " + CART_TOKEN,
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            }
        });

        const data = await res.json();
        loadingEl.classList.add('hidden');

        if (!res.ok || !data.success || !data.data || data.data.length === 0) {
            emptyEl.classList.remove('hidden');
            itemsEl.classList.add('hidden');
            updateTotals([]);
            return;
        }

        emptyEl.classList.add('hidden');
        itemsEl.classList.remove('hidden');
        displayCartItems(data.data);
        updateTotals(data.data);
    } catch (error) {
        console.error("Cart error:", error);
        loadingEl.classList.add('hidden');
        emptyEl.classList.remove('hidden');
    }
}

// Display cart items
function displayCartItems(items) {
    const container = document.getElementById('cart-items');
    const countEl = document.getElementById('cart-count');
    
    countEl.textContent = items.length === 1 ? '1 item' : items.length + ' items';
    
    container.innerHTML = items.map(item => {
        const imageUrl = getImageUrl(item.image_url);
        const subtotal = parseFloat(item.price) * parseInt(item.quantity);
        
        return `
            <div class="flex items-center gap-6 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow" data-pet-id="${item.pet_id}">
                <div class="relative w-24 h-24 flex-shrink-0">
                    <img src="${imageUrl}" alt="${item.product_name}" class="w-full h-full object-cover rounded-lg" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">${item.product_name}</h3>
                    <p class="text-sm text-gray-600 mb-2">${item.pet_type} - ${item.accessories_type}</p>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <span class="px-4 py-1 border-x border-gray-300">${item.quantity}</span>
                        </div>
                        <span class="text-lg font-bold text-blue-700">Rs. ${parseFloat(item.price).toFixed(2)}</span>
                        <span class="text-sm text-gray-500">× ${item.quantity} = Rs. ${subtotal.toFixed(2)}</span>
                    </div>
                </div>
                <button onclick="removeFromCart(${item.pet_id})" class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `;
    }).join('');
}

// Remove item from cart
async function removeFromCart(petId) {
    if (!CART_TOKEN) {
        alert("Please login first");
        return;
    }

    if (!confirm("Remove this item from cart?")) {
        return;
    }

    // Get CSRF token for the request
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    try {
        const res = await fetch(`/api/cart/${petId}`, {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + CART_TOKEN,
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            }
        });

        const data = await res.json();

        if (res.ok && data.success) {
            loadCart(); // Reload cart
        } else {
            alert(data.message || "Failed to remove item");
        }
    } catch (error) {
        console.error("Remove error:", error);
        alert("Error removing item");
    }
}

// Update totals
function updateTotals(items) {
    const subtotal = items.reduce((sum, item) => {
        return sum + (parseFloat(item.price) * parseInt(item.quantity));
    }, 0);
    
    const tax = subtotal * 0.08; // 8% tax
    const total = subtotal + tax;

    document.getElementById('subtotal').textContent = `Rs. ${subtotal.toFixed(2)}`;
    document.getElementById('tax').textContent = `Rs. ${tax.toFixed(2)}`;
    document.getElementById('total').textContent = `Rs. ${total.toFixed(2)}`;
}

// Load cart on page load
document.addEventListener('DOMContentLoaded', loadCart);
</script>
@endsection
