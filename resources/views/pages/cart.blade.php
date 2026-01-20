@extends('layouts.app')

@section('title', 'Shopping Cart - PetMart')

@section('content')
<!-- Confirmation Modal -->
<div id="confirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300">
    <div id="modalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-8">
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-red-100 rounded-full">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-3">Remove Item?</h3>
            <p class="text-gray-600 text-center mb-8">Are you sure you want to remove this item from your cart?</p>
            <div class="flex gap-3">
                <button onclick="cancelRemove()" class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg font-semibold transition-colors duration-200">
                    Cancel
                </button>
                <button onclick="confirmRemove()" class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors duration-200">
                    Remove
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Notification -->
<div id="successNotification" class="hidden fixed top-20 sm:top-24 right-4 sm:right-8 z-50 transform translate-x-full transition-transform duration-300 max-w-[calc(100vw-2rem)] sm:max-w-md">
    <div class="bg-white rounded-xl shadow-2xl p-4 sm:p-6 flex items-center gap-3 sm:gap-4 border-l-4 border-green-500">
        <div class="flex-shrink-0 w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-gray-900 text-sm sm:text-base">Item Removed</p>
            <p class="text-xs sm:text-sm text-gray-600">Product removed successfully</p>
        </div>
    </div>
</div>

<div class="min-h-screen bg-gray-50 py-6 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-4 sm:mb-8">Shopping Cart</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-2">
                        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Cart Items</h2>
                        <span class="text-sm sm:text-base text-gray-600" id="cart-count">0 items</span>
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
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 lg:sticky lg:top-24">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6">Order Summary</h2>

                    <div class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
                        <div class="flex justify-between text-sm sm:text-base text-gray-600">
                            <span>Subtotal</span>
                            <span id="subtotal" class="font-semibold">Rs. 0.00</span>
                        </div>
                        <div class="flex justify-between text-sm sm:text-base text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-semibold">Free</span>
                        </div>
                        <div class="flex justify-between text-sm sm:text-base text-gray-600">
                            <span>Tax (8%)</span>
                            <span id="tax" class="font-semibold">Rs. 0.00</span>
                        </div>
                        <div class="pt-3 sm:pt-4 border-t border-gray-200 flex justify-between text-lg sm:text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-blue-700" id="total">Rs. 0.00</span>
                        </div>
                    </div>

                    <div class="mb-4 sm:mb-6">
                        <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Enter code" 
                                   class="flex-1 px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 sm:px-6 py-2 rounded-lg font-semibold transition-colors text-sm sm:text-base whitespace-nowrap">
                                Apply
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('payment') }}" class="block w-full bg-blue-700 hover:bg-blue-800 text-white text-center py-3 sm:py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-3 sm:mb-4 text-sm sm:text-base">
                        Proceed to Checkout
                    </a>

                    <div class="flex items-center justify-center gap-2 text-xs sm:text-sm text-gray-600">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

// I added this helper to properly format product image URLs
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

// This fetches cart items from the API and displays them
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

// This builds the HTML for each product in the cart
function displayCartItems(items) {
    const container = document.getElementById('cart-items');
    const countEl = document.getElementById('cart-count');
    
    countEl.textContent = items.length === 1 ? '1 item' : items.length + ' items';
    
    container.innerHTML = items.map(item => {
        const imageUrl = getImageUrl(item.image_url);
        const subtotal = parseFloat(item.price) * parseInt(item.quantity);
        
        return `
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4 md:gap-6 p-3 sm:p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow" data-pet-id="${item.pet_id}">
                <div class="relative w-20 h-20 sm:w-24 sm:h-24 flex-shrink-0">
                    <img src="${imageUrl}" alt="${item.product_name}" class="w-full h-full object-cover rounded-lg" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                </div>
                <div class="flex-1 w-full sm:w-auto">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 pr-2">${item.product_name}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 mb-2">${item.pet_type} - ${item.accessories_type}</p>
                        </div>
                        <button onclick="removeFromCart(${item.pet_id})" class="sm:hidden text-red-500 hover:text-red-700 p-1 hover:bg-red-50 rounded-lg transition-colors flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 sm:gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <span class="px-3 sm:px-4 py-1 text-sm sm:text-base">${item.quantity}</span>
                        </div>
                        <span class="text-base sm:text-lg font-bold text-blue-700">Rs. ${parseFloat(item.price).toFixed(2)}</span>
                        <span class="text-xs sm:text-sm text-gray-500">× ${item.quantity} = Rs. ${subtotal.toFixed(2)}</span>
                    </div>
                </div>
                <button onclick="removeFromCart(${item.pet_id})" class="hidden sm:block text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-colors flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `;
    }).join('');
}

// Keeping track of which item the user wants to remove
let pendingRemovalPetId = null;

// This shows the confirmation popup before removing an item
function showModal() {
    const modal = document.getElementById('confirmModal');
    const modalContent = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

// Closing the confirmation modal
function hideModal() {
    const modal = document.getElementById('confirmModal');
    const modalContent = document.getElementById('modalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        pendingRemovalPetId = null;
    }, 300);
}

// Showing a green notification after removing an item
function showSuccessNotification() {
    const notification = document.getElementById('successNotification');
    
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

// User clicked "Cancel" so just close the modal
function cancelRemove() {
    hideModal();
}

// User clicked "Remove" so let's delete the item from cart
async function confirmRemove() {
    if (!pendingRemovalPetId) return;
    
    hideModal();
    
    // Get CSRF token for the request
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    try {
        const res = await fetch(`/api/cart/${pendingRemovalPetId}`, {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + CART_TOKEN,
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            }
        });

        const data = await res.json();

        if (res.ok && data.success) {
            showSuccessNotification();
            loadCart(); // Reload cart
        } else {
            alert(data.message || "Failed to remove item");
        }
    } catch (error) {
        console.error("Remove error:", error);
        alert("Error removing item");
    }
}

// This triggers when user clicks the trash icon
async function removeFromCart(petId) {
    if (!CART_TOKEN) {
        alert("Please login first");
        return;
    }

    pendingRemovalPetId = petId;
    showModal();
}

// Calculating and updating the subtotal, tax, and total
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

// If user clicks outside the modal, I'll close it
document.getElementById('confirmModal')?.addEventListener('click', function(e) {
    if (e.target.id === 'confirmModal') {
        hideModal();
    }
});

// Loading the cart when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // I'm clearing any cached cart data first
    if (typeof(Storage) !== "undefined") {
        localStorage.removeItem('cart_items');
        localStorage.removeItem('cart_count');
        sessionStorage.removeItem('cart_items');
        sessionStorage.removeItem('cart_count');
    }
    
    // Now load fresh cart from server
    loadCart();
    
    // I'm checking if we just came back from payment, force refresh the cart
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('payment_success') === '1' || urlParams.get('order_success') === '1') {
        // Force reload cart from server multiple times to ensure it's cleared
        setTimeout(() => {
            loadCart();
        }, 300);
        
        setTimeout(() => {
            loadCart();
            // Clean the URL
            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        }, 800);
    }
});
</script>
@endsection
