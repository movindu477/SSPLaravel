@extends('layouts.app')

@section('title', 'Checkout - PetMart')

@section('content')
<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>

<div class="min-h-screen bg-gray-100 flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <!-- Main Container -->
    <div class="w-full max-w-7xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row min-h-[600px]">
        
        <!-- Left Side: Order Summary (Dark Theme) -->
        <div class="w-full lg:w-5/12 bg-gray-900 p-8 lg:p-12 text-white flex flex-col relative">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold tracking-wide">Order Summary</h2>
                <span class="bg-gray-800 text-gray-300 text-xs py-1 px-3 rounded-full uppercase tracking-wider font-semibold" id="item-count-badge">0 items</span>
            </div>

            <!-- Items List -->
            <div class="flex-1 overflow-y-auto pr-2 space-y-6 custom-scrollbar" id="order-items-container">
                <!-- Skeleton Loader -->
                <div class="animate-pulse space-y-4">
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 bg-gray-800 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-800 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 bg-gray-800 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-800 rounded w-1/2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Totals -->
            <div class="mt-8 pt-8 border-t border-gray-800 space-y-3">
                <div class="flex justify-between text-gray-400">
                    <span>Subtotal</span>
                    <span class="text-white font-medium" id="summary-subtotal">Rs. 0.00</span>
                </div>
                <!-- <div class="flex justify-between text-gray-400">
                    <span>Discount</span>
                    <span class="text-green-400 font-medium">-$0.00</span>
                </div> -->
                <div class="flex justify-between text-gray-400">
                    <span>Shipping</span>
                    <span class="text-white font-medium">Free</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>Tax (8%)</span>
                    <span class="text-white font-medium" id="summary-tax">Rs. 0.00</span>
                </div>
                
                <div class="flex justify-between items-center pt-4 mt-2 border-t border-gray-800">
                    <span class="text-xl font-bold">Total</span>
                    <span class="text-3xl font-bold text-blue-400" id="summary-total">Rs. 0.00</span>
                </div>
            </div>
            
            <!-- Back to Shop -->
            <div class="mt-8 text-center lg:text-left">
                <a href="{{ route('shop') }}" class="text-gray-500 hover:text-white text-sm transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Shop
                </a>
            </div>
        </div>

        <!-- Right Side: Stripe Payment (Light Theme) -->
        <div class="w-full lg:w-7/12 bg-gray-50 p-8 lg:p-12 relative">
            <div class="max-w-md mx-auto h-full flex flex-col justify-center">
                
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Payment Details</h2>
                    <p class="text-gray-500 text-sm">Complete your purchase securely.</p>
                </div>

                <form id="payment-form" class="space-y-6">
                    @csrf
                    <!-- Contact Info (Pre-filled if auth) -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email" value="{{ auth()->user()->email ?? '' }}" class="block w-full rounded-lg border-gray-300 bg-white py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="you@example.com" required>
                    </div>

                     <!-- Stripe Element Placeholder -->
                    <div id="payment-element" class="min-h-[290px]">
                        <!-- Stripe Elements will be inserted here -->
                        <div class="animate-pulse space-y-4 mt-4">
                           <div class="h-10 bg-gray-200 rounded"></div>
                           <div class="h-10 bg-gray-200 rounded"></div>
                           <div class="h-40 bg-gray-200 rounded"></div>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="payment-message" class="hidden text-sm text-red-600 bg-red-50 p-3 rounded-lg border border-red-200"></div>

                    <!-- Pay Button -->
                    <button id="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-[1.01]">
                        <span id="button-text">Pay Now</span>
                        <div class="spinner hidden ml-2" id="spinner">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                    
                    <div class="flex items-center justify-center gap-2 text-xs text-gray-400 mt-4">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Encrypted & Secure Payment
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// --- Configuration ---
const STRIPE_KEY = "{{ config('services.stripe.key') }}";
const ORDER_TOKEN = "{{ session('user_token') }}"; // Assuming user token handling matches existing pattern
const API_CART_URL = "/api/cart";
const API_INTENT_URL = "/api/create-payment-intent"; // Endpoint that returns client_secret
const SUCCESS_URL = "{{ route('shop') }}?order_success=1";

let stripe;
let elements;
let cartTotal = 0;

document.addEventListener('DOMContentLoaded', async () => {
    // 1. Initialize logic
    if (!STRIPE_KEY) {
        console.error("Stripe Key missing!");
        alert("Payment configuration error.");
        return;
    }
    
    stripe = Stripe(STRIPE_KEY);

    // 2. Fetch Cart Data
    await loadCartAndInitializePayment();
});

async function loadCartAndInitializePayment() {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Fetch Cart Items
        const res = await fetch(API_CART_URL, {
            headers: {
                "Authorization": "Bearer " + ORDER_TOKEN, // If token logic is used
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            }
        });

        if (!res.ok) throw new Error("Failed to fetch cart");
        const data = await res.json();
        
        if (!data.data || data.data.length === 0) {
            alert("Your cart is empty!");
            window.location.href = "{{ route('shop') }}";
            return;
        }

        // Render Summary
        renderOrderSummary(data.data);
        
        // Calculate Total amount for Stripe
        // Note: Frontend calculation is insecure for production but requested 'frontend only'.
        // Backend should validate this derived from cart.
        await initializeStripeElements(cartTotal);

    } catch (e) {
        console.error("Initialization Error:", e);
        document.getElementById('order-items-container').innerHTML = `<div class="text-red-400 text-center">Failed to load order details.</div>`;
    }
}

function renderOrderSummary(items) {
    const container = document.getElementById('order-items-container');
    container.innerHTML = '';
    
    let subtotal = 0;

    items.forEach(item => {
        subtotal += parseFloat(item.price) * parseInt(item.quantity);
        
        // Dynamic Image handling
        let imgUrl = item.image_url || 'images/Petmart.png';
        if (!imgUrl.startsWith('http') && !imgUrl.startsWith('/')) imgUrl = '/' + imgUrl;
        if (imgUrl.startsWith('//')) imgUrl = imgUrl.substring(1);

        const html = `
            <div class="flex gap-4 items-center">
                <div class="w-16 h-16 bg-white rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                    <img src="${imgUrl}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-white font-medium text-sm truncate">${item.product_name}</h4>
                    <p class="text-gray-400 text-xs mt-1">Qty: ${item.quantity}</p>
                </div>
                <div class="text-white font-semibold text-sm">
                    Rs. ${(parseFloat(item.price) * parseInt(item.quantity)).toFixed(2)}
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });

    // Calc Totals
    const tax = subtotal * 0.08;
    cartTotal = subtotal + tax;

    document.getElementById('item-count-badge').textContent = `${items.length} items`;
    document.getElementById('summary-subtotal').textContent = `Rs. ${subtotal.toFixed(2)}`;
    document.getElementById('summary-tax').textContent = `Rs. ${tax.toFixed(2)}`;
    document.getElementById('summary-total').textContent = `Rs. ${cartTotal.toFixed(2)}`;
    
    // Update button text
    document.getElementById('button-text').textContent = `Pay Rs. ${cartTotal.toFixed(2)}`;
}

async function initializeStripeElements(amount) {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Create PaymentIntent via Backend
        const response = await fetch(API_INTENT_URL, {
            method: "POST",
            headers: { 
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            },
            body: JSON.stringify({ 
                amount: amount,
                email: document.getElementById('email').value 
            })
        });

        const { client_secret, error } = await response.json();
        
        if (error) throw new Error(error);

        // Mount Elements
        const appearance = {
            theme: 'stripe',
            variables: {
                colorPrimary: '#2563eb',
            },
        };
        elements = stripe.elements({ appearance, clientSecret: client_secret });

        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");

    } catch (e) {
        console.error("Stripe Init Failed:", e);
        showMessage(e.message || "Failed to initialize payment system.");
    }
}

// Handle Form Submit
document.getElementById("payment-form").addEventListener("submit", async function(e) {
    e.preventDefault();
    setLoading(true);

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: SUCCESS_URL, // Redirects here after payment
            receipt_email: document.getElementById("email").value,
        },
    });

    // This point is reached only if there is an immediate error/validation fail
    if (error) {
        showMessage(error.message);
        setLoading(false);
    } else {
        // Success - redirect happens automatically
    }
});

// Helpers
function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    setTimeout(() => messageContainer.classList.add("hidden"), 5000);
}

function setLoading(isLoading) {
    const submitBtn = document.querySelector("#submit");
    const spinner = document.querySelector("#spinner");
    const buttonText = document.querySelector("#button-text");

    if (isLoading) {
        submitBtn.disabled = true;
        spinner.classList.remove("hidden");
        buttonText.classList.add("hidden");
    } else {
        submitBtn.disabled = false;
        spinner.classList.add("hidden");
        buttonText.classList.remove("hidden");
    }
}
</script>

<style>
/* Custom Scrollbar for Items List */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: #1f2937; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #4b5563; 
    border-radius: 3px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #6b7280; 
}
</style>
@endsection

@section('content')
@if(session('success') && session('order_id'))
    <script>
        // Payment was successful - show success modal
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Payment Success - Order ID: {{ session('order_id') }}');
            setTimeout(function() {
                showSuccessModal({{ session('order_id') }});
            }, 500);
        });
    </script>
@elseif(session('error'))
    <script>
        // Only show error if there's no success
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Payment Error: {{ session('error') }}');
            showErrorModal("{{ session('error') }}");
        });
    </script>
@elseif(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            alert("{{ session('info') }}");
            window.location.href = "{{ route('shop') }}";
        });
    </script>
@endif
<div class="min-h-screen bg-gray-50 py-6 sm:py-8 md:py-12">
    <div class="max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-2">Checkout</h1>
            <div class="flex items-center gap-1.5 sm:gap-2 text-sm sm:text-base text-gray-600">
                <span class="bg-blue-700 text-white rounded-full w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-xs sm:text-sm font-semibold">1</span>
                <span class="text-blue-700 font-semibold text-xs sm:text-base">Cart</span>
                <span class="text-gray-400">→</span>
                <span class="bg-blue-700 text-white rounded-full w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-xs sm:text-sm font-semibold">2</span>
                <span class="text-blue-700 font-semibold text-xs sm:text-base">Payment</span>
                <span class="text-gray-400">→</span>
                <span class="bg-gray-300 text-gray-600 rounded-full w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center text-xs sm:text-sm font-semibold">3</span>
                <span class="text-gray-400 text-xs sm:text-base">Confirmation</span>
            </div>
        </div>

        <form id="payment-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <!-- Shipping Address -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shipping Address</h2>
                        <div class="space-y-4">
                                <!-- Modern Inputs -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">First Name</label>
                                        <input type="text" name="first_name" id="first_name" required placeholder="John"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" required placeholder="Doe"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">Email Address</label>
                                        <input type="email" name="email" id="email" required placeholder="john@example.com"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">Phone Number</label>
                                        <input type="tel" name="shipping_phone" id="shipping_phone" required placeholder="+1 (555) 000-0000"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                </div>

                                <div class="relative group">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">Shipping Address</label>
                                    <input type="text" name="shipping_address" id="shipping_address" required placeholder="123 Luxury Lane"
                                           class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">City</label>
                                        <input type="text" name="shipping_city" id="shipping_city" required placeholder="Colombo"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">Province</label>
                                        <input type="text" name="shipping_province" id="shipping_province" required placeholder="Western"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                    <div class="relative group">
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 transition-colors group-focus-within:text-blue-600">ZIP Code</label>
                                        <input type="text" name="shipping_zip" id="shipping_zip" required placeholder="10100"
                                               class="w-full px-4 py-4 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all duration-300 outline-none shadow-sm">
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Payment Method</h2>
                        <div class="border-2 border-blue-700 rounded-lg p-4 bg-blue-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    <div>
                                        <label class="font-semibold text-gray-800 text-lg">Credit/Debit Card</label>
                                        <p class="text-sm text-gray-600 mt-1">Secure payment via Stripe</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded">VISA</span>
                                    <span class="text-xs bg-red-600 text-white px-2 py-1 rounded">MC</span>
                                    <span class="text-xs bg-blue-500 text-white px-2 py-1 rounded">AMEX</span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-blue-200">
                                <p class="text-sm text-gray-600">You will be redirected to Stripe's secure checkout page to complete your payment.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Summary</h2>

                        <!-- Loading State -->
                        <div id="summary-loading" class="text-center py-8">
                            <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-700 border-t-transparent mx-auto"></div>
                            <p class="mt-2 text-gray-600 text-sm">Loading...</p>
                        </div>

                        <!-- Cart Items -->
                        <div id="summary-items" class="space-y-4 mb-6 hidden"></div>

                        <!-- Totals Section -->
                        <div class="space-y-4 mb-8 bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-inner">
                            <div class="flex justify-between items-center text-gray-500">
                                <span class="text-sm font-medium">Subtotal</span>
                                <span id="summary-subtotal" class="font-bold text-gray-800">Rs. 0.00</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-500">
                                <span class="text-sm font-medium">Delivery</span>
                                <span class="text-green-600 font-bold uppercase text-xs tracking-widest">Free</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-500 pb-4 border-b border-gray-200">
                                <span class="text-sm font-medium">Service Tax (8%)</span>
                                <span id="summary-tax" class="font-bold text-gray-800">Rs. 0.00</span>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-lg font-extrabold text-gray-900">Amount Due</span>
                                <span class="text-2xl font-black text-blue-700" id="summary-total">Rs. 0.00</span>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-4 disabled:opacity-50 disabled:cursor-not-allowed">
                            Proceed to Payment
                        </button>

                        <div class="flex items-center justify-center gap-2 text-sm text-gray-600 mb-4">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Secure payment</span>
                        </div>

                        <div class="text-xs text-gray-500 text-center">
                            By placing your order, you agree to our Terms of Service and Privacy Policy
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Animated Success Alert Modal -->
<div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-0" id="success-modal-content">
        <div class="text-center">
            <!-- Success Icon Animation -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-4 animate-bounce">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <!-- Success Message -->
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Order Placed Successfully!</h3>
            <p class="text-gray-600 mb-4">Your order has been confirmed and will be processed shortly.</p>
            
            <!-- Order ID -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-1">Order ID</p>
                <p class="text-xl font-bold text-blue-700" id="order-id-display">#0000</p>
            </div>
            
            <!-- Action Button -->
            <button onclick="closeSuccessModal()" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                Continue Shopping
            </button>
        </div>
    </div>
</div>

<!-- Error Alert Modal -->
<div id="error-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-0" id="error-modal-content">
        <div class="text-center">
            <!-- Error Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-4">
                <svg class="h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            
            <!-- Error Message -->
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Order Failed</h3>
            <p class="text-gray-600 mb-6" id="error-message">Please try again.</p>
            
            <!-- Action Button -->
            <button onclick="closeErrorModal()" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                Close
            </button>
        </div>
    </div>
</div>

<script>
const ORDER_TOKEN = "{{ session('user_token') }}";
const userData = {
    name: "{{ auth()->user()->name ?? '' }}",
    email: "{{ auth()->user()->email ?? '' }}",
    phone: "{{ auth()->user()->phonenumber ?? '' }}",
    address: "{{ auth()->user()->address ?? '' }}",
    city: "{{ auth()->user()->city ?? '' }}"
};

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

// Pre-fill user data
function prefillUserData() {
    if (userData.name) {
        const names = userData.name.split(' ');
        document.getElementById('first_name').value = names[0] || '';
        document.getElementById('last_name').value = names.slice(1).join(' ') || '';
    }
    if (userData.email) {
        document.getElementById('email').value = userData.email;
    }
    if (userData.phone) {
        document.getElementById('shipping_phone').value = userData.phone;
    }
    if (userData.address) {
        document.getElementById('shipping_address').value = userData.address;
    }
    if (userData.city) {
        document.getElementById('shipping_city').value = userData.city;
    }
}

// Load cart items for summary
async function loadCartSummary() {
    const loadingEl = document.getElementById('summary-loading');
    const itemsEl = document.getElementById('summary-items');

    if (!ORDER_TOKEN) {
        loadingEl.classList.add('hidden');
        alert("Please login first");
        window.location.href = "{{ route('login') }}";
        return;
    }

    // Get CSRF token for the request
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    try {
        const res = await fetch("/api/cart", {
            headers: {
                "Authorization": "Bearer " + ORDER_TOKEN,
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            }
        });

        const data = await res.json();
        loadingEl.classList.add('hidden');

        if (!res.ok || !data.success || !data.data || data.data.length === 0) {
            alert("Your cart is empty. Please add items to cart first.");
            window.location.href = "{{ route('cart') }}";
            return;
        }

        itemsEl.classList.remove('hidden');
        displaySummaryItems(data.data);
        updateSummaryTotals(data.data);
    } catch (error) {
        console.error("Cart error:", error);
        loadingEl.classList.add('hidden');
        alert("Error loading cart. Please try again.");
    }
}

// Display summary items
function displaySummaryItems(items) {
    const container = document.getElementById('summary-items');
    
    container.innerHTML = items.map(item => {
        const imageUrl = getImageUrl(item.image_url);
        
        return `
            <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                <img src="${imageUrl}" alt="${item.product_name}" class="w-16 h-16 object-cover rounded-lg" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">${item.product_name}</p>
                    <p class="text-sm text-gray-600">Qty: ${item.quantity}</p>
                </div>
                <span class="font-semibold text-gray-800">Rs. ${(parseFloat(item.price) * parseInt(item.quantity)).toFixed(2)}</span>
            </div>
        `;
    }).join('');
}

// Update summary totals
function updateSummaryTotals(items) {
    const subtotal = items.reduce((sum, item) => {
        return sum + (parseFloat(item.price) * parseInt(item.quantity));
    }, 0);
    
    const tax = subtotal * 0.08;
    const total = subtotal + tax;

    document.getElementById('summary-subtotal').textContent = `Rs. ${subtotal.toFixed(2)}`;
    document.getElementById('summary-tax').textContent = `Rs. ${tax.toFixed(2)}`;
    document.getElementById('summary-total').textContent = `Rs. ${total.toFixed(2)}`;
}



// Show success modal with animation
function showSuccessModal(orderId) {
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('success-modal-content');
    const orderIdDisplay = document.getElementById('order-id-display');
    
    orderIdDisplay.textContent = '#' + orderId;
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    
    // Trigger animation
    setTimeout(() => {
        content.classList.remove('scale-0');
        content.classList.add('scale-100');
    }, 10);
}

// Update cart count in navbar
function updateCartCount(count = 0) {
    const cartCountElements = document.querySelectorAll('[data-cart-count]');
    cartCountElements.forEach(element => {
        element.textContent = count;
        // Hide badge if count is 0
        if (count === 0) {
            element.classList.add('hidden');
        }
    });
    
    // Also update any cart count badges
    const cartBadges = document.querySelectorAll('.cart-count-badge');
    cartBadges.forEach(badge => {
        if (count === 0) {
            badge.classList.add('hidden');
        } else {
            badge.classList.remove('hidden');
            badge.textContent = count;
        }
    });
}

// Close success modal
function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('success-modal-content');
    
    content.classList.remove('scale-100');
    content.classList.add('scale-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        // Update cart count to 0 and redirect to shop
        updateCartCount(0);
        refreshCartAndRedirect();
    }, 300);
}

// Show error modal
function showErrorModal(message) {
    const modal = document.getElementById('error-modal');
    const content = document.getElementById('error-modal-content');
    const errorMessage = document.getElementById('error-message');
    
    errorMessage.textContent = message || "Failed to place order. Please try again.";
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    
    setTimeout(() => {
        content.classList.remove('scale-0');
        content.classList.add('scale-100');
    }, 10);
}

// Close error modal
function closeErrorModal() {
    const modal = document.getElementById('error-modal');
    const content = document.getElementById('error-modal-content');
    
    content.classList.remove('scale-100');
    content.classList.add('scale-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }, 300);
}

// Refresh cart and redirect
async function refreshCartAndRedirect() {
    try {
        // I'm clearing all possible cart storage to force a fresh load
        if (typeof(Storage) !== "undefined") {
            localStorage.removeItem('cart_items');
            localStorage.removeItem('cart_count');
            sessionStorage.removeItem('cart_items');
            sessionStorage.removeItem('cart_count');
        }
        
        // Update all cart badges to 0
        updateCartCount(0);
        
        // Redirect to shop page with success message
        window.location.href = "{{ route('shop') }}?order_success=1&t=" + Date.now();
    } catch (error) {
        console.error("Redirect error:", error);
        window.location.href = "{{ route('shop') }}?t=" + Date.now();
    }
}

// Submit order
document.getElementById('payment-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    if (!ORDER_TOKEN) {
        showErrorModal("Please login first");
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 2000);
        return;
    }

    const submitBtn = document.getElementById('submit-btn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Processing...';

    const formData = new FormData(this);

    // Basic Validation
    if (!formData.get('email') || !formData.get('email').includes('@')) {
        showErrorModal("Please enter a valid email address.");
        submitBtn.disabled = false;
        submitBtn.textContent = 'Proceed to Payment';
        return;
    }

    // Prepare all shipping data from form
    const shippingData = {
        first_name: formData.get('first_name'),
        last_name: formData.get('last_name'),
        email: formData.get('email'),
        shipping_phone: formData.get('shipping_phone'),
        shipping_address: formData.get('shipping_address'),
        shipping_city: formData.get('shipping_city'),
        shipping_province: formData.get('shipping_province'),
        shipping_zip: formData.get('shipping_zip')
    };

    // Create Stripe checkout session
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        const res = await fetch("{{ route('stripe.checkout') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken || ""
            },
            body: JSON.stringify(shippingData)
        });

        const data = await res.json();
        
        if (res.ok && data.url) {
            // Success animation before redirect
            submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-3 inline" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Redirecting to Secure Payment...';
            
            setTimeout(() => {
                window.location.href = data.url;
            }, 800);
        } else {
            const errorMessage = data.error || data.message || "Failed to create checkout session. Please try again.";
            console.error("Stripe API Error:", data);
            showErrorModal(errorMessage);
            submitBtn.disabled = false;
            submitBtn.textContent = 'Proceed to Payment';
        }
    } catch (error) {
        console.error("Stripe error:", error);
        showErrorModal("Network error. Please check your connection and try again.");
        submitBtn.disabled = false;
        submitBtn.textContent = 'Proceed to Payment';
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    prefillUserData();
    loadCartSummary();
});
</script>
@endsection
