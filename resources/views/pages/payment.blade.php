@extends('layouts.app')

@section('title', 'Payment - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Checkout</h1>
            <div class="flex items-center gap-2 text-gray-600">
                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">1</span>
                <span class="text-cyan-600 font-semibold">Cart</span>
                <span class="text-gray-400">→</span>
                <span class="bg-cyan-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">2</span>
                <span class="text-cyan-600 font-semibold">Payment</span>
                <span class="text-gray-400">→</span>
                <span class="bg-gray-300 text-gray-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">3</span>
                <span class="text-gray-400">Confirmation</span>
            </div>
        </div>

        <form id="payment-form">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <!-- Shipping Address -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shipping Address</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                    <input type="text" name="first_name" id="first_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                    <input type="text" name="last_name" id="last_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" id="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                                <input type="tel" name="shipping_phone" id="shipping_phone" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                <input type="text" name="shipping_address" id="shipping_address" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                    <input type="text" name="shipping_city" id="shipping_city" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Province *</label>
                                    <input type="text" name="shipping_province" id="shipping_province" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code *</label>
                                    <input type="text" name="shipping_zip" id="shipping_zip" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Payment Method</h2>
                        <div class="space-y-4">
                            <div class="border-2 border-cyan-600 rounded-lg p-4 bg-cyan-50 payment-method-option" data-method="card">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="payment_method" id="card" value="card" checked class="w-5 h-5 text-cyan-600">
                                        <label for="card" class="font-semibold text-gray-800 cursor-pointer">Credit/Debit Card</label>
                                    </div>
                                    <div class="flex gap-2">
                                        <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded">VISA</span>
                                        <span class="text-xs bg-red-600 text-white px-2 py-1 rounded">MC</span>
                                    </div>
                                </div>
                                <div id="card-details" class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                        <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                            <input type="text" name="card_expiry" placeholder="MM/YY" maxlength="5"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                            <input type="text" name="card_cvv" placeholder="123" maxlength="4"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-cyan-300 transition-colors cursor-pointer payment-method-option" data-method="cod">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="payment_method" id="cod" value="cod" class="w-5 h-5 text-cyan-600">
                                        <label for="cod" class="font-semibold text-gray-800 cursor-pointer">Cash on Delivery</label>
                                    </div>
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
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
                            <div class="animate-spin rounded-full h-8 w-8 border-4 border-cyan-500 border-t-transparent mx-auto"></div>
                            <p class="mt-2 text-gray-600 text-sm">Loading...</p>
                        </div>

                        <!-- Cart Items -->
                        <div id="summary-items" class="space-y-4 mb-6 hidden"></div>

                        <!-- Totals -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span id="summary-subtotal">Rs. 0.00</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax (8%)</span>
                                <span id="summary-tax">Rs. 0.00</span>
                            </div>
                            <div class="pt-4 border-t border-gray-200 flex justify-between text-xl font-bold text-gray-800">
                                <span>Total</span>
                                <span class="text-cyan-600" id="summary-total">Rs. 0.00</span>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-4 disabled:opacity-50 disabled:cursor-not-allowed">
                            Complete Order
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
            <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-1">Order ID</p>
                <p class="text-xl font-bold text-cyan-600" id="order-id-display">#0000</p>
            </div>
            
            <!-- Action Button -->
            <button onclick="closeSuccessModal()" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
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
    name: "{{ session('user_name', '') }}",
    email: "{{ session('user_email', '') }}",
    phone: "{{ session('user_phone', '') }}",
    address: "{{ session('user_address', '') }}"
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

    try {
        const res = await fetch("/api/cart", {
            headers: {
                "Authorization": "Bearer " + ORDER_TOKEN,
                "Accept": "application/json"
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

// Payment method selection
document.querySelectorAll('.payment-method-option').forEach(option => {
    option.addEventListener('click', function() {
        const method = this.dataset.method;
        document.querySelectorAll('.payment-method-option').forEach(opt => {
            opt.classList.remove('border-cyan-600', 'bg-cyan-50');
            opt.classList.add('border-gray-200');
        });
        this.classList.remove('border-gray-200');
        this.classList.add('border-cyan-600', 'bg-cyan-50');
        document.getElementById(method).checked = true;
        
        const cardDetails = document.getElementById('card-details');
        if (method === 'card') {
            cardDetails.style.display = 'block';
        } else {
            cardDetails.style.display = 'none';
        }
    });
});

// Format card number
document.querySelector('input[name="card_number"]')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s/g, '');
    let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formatted;
});

// Format expiry date
document.querySelector('input[name="card_expiry"]')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
});

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

// Close success modal
function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    const content = document.getElementById('success-modal-content');
    
    content.classList.remove('scale-100');
    content.classList.add('scale-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        // Refresh cart and redirect
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
    // Clear cart from API if needed (it's already cleared by backend, but we can verify)
    try {
        // Redirect to cart page which will show empty cart
        window.location.href = "{{ route('cart') }}";
    } catch (error) {
        console.error("Redirect error:", error);
        window.location.href = "{{ route('home') }}";
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
    const paymentMethod = formData.get('payment_method');

    // Validate card details if card payment
    if (paymentMethod === 'card') {
        const cardNumber = formData.get('card_number');
        const cardExpiry = formData.get('card_expiry');
        const cardCvv = formData.get('card_cvv');

        if (!cardNumber || cardNumber.replace(/\s/g, '').length < 13) {
            showErrorModal("Please enter a valid card number");
            submitBtn.disabled = false;
            submitBtn.textContent = 'Complete Order';
            return;
        }
        if (!cardExpiry || cardExpiry.length !== 5) {
            showErrorModal("Please enter a valid expiry date (MM/YY)");
            submitBtn.disabled = false;
            submitBtn.textContent = 'Complete Order';
            return;
        }
        if (!cardCvv || cardCvv.length < 3) {
            showErrorModal("Please enter a valid CVV");
            submitBtn.disabled = false;
            submitBtn.textContent = 'Complete Order';
            return;
        }
    }

    try {
        // OrderController doesn't require shipping fields, just create order
        const orderData = {};

        const res = await fetch("/api/orders", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + ORDER_TOKEN,
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(orderData)
        });

        const data = await res.json();

        if (res.ok && data.success) {
            // Show success modal with animation
            showSuccessModal(data.order_id);
        } else {
            showErrorModal(data.message || "Failed to place order. Please try again.");
            submitBtn.disabled = false;
            submitBtn.textContent = 'Complete Order';
        }
    } catch (error) {
        console.error("Order error:", error);
        showErrorModal("Error placing order. Please try again.");
        submitBtn.disabled = false;
        submitBtn.textContent = 'Complete Order';
    }
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    prefillUserData();
    loadCartSummary();
});
</script>
@endsection
