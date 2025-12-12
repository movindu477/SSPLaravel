@extends('layouts.app')

@section('title', 'Payment - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Checkout</h1>
            <div class="flex items-center gap-2 text-gray-600">
                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">1</span>
                <span class="text-purple-600 font-semibold">Cart</span>
                <span class="text-gray-400">→</span>
                <span class="bg-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">2</span>
                <span class="text-purple-600 font-semibold">Payment</span>
                <span class="text-gray-400">→</span>
                <span class="bg-gray-300 text-gray-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-semibold">3</span>
                <span class="text-gray-400">Confirmation</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shipping Address</h2>
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" value="John" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" value="Doe" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="john.doe@example.com" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" value="+94 77 123 4567" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" value="123 Main Street" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" value="Colombo" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                                <input type="text" value="Western" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                                <input type="text" value="00100" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Payment Method</h2>
                    <div class="space-y-4">
                        <div class="border-2 border-purple-600 rounded-lg p-4 bg-purple-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment" id="card" checked class="w-5 h-5 text-purple-600">
                                    <label for="card" class="font-semibold text-gray-800 cursor-pointer">Credit/Debit Card</label>
                                </div>
                                <div class="flex gap-2">
                                    <span class="text-xs bg-blue-600 text-white px-2 py-1 rounded">VISA</span>
                                    <span class="text-xs bg-red-600 text-white px-2 py-1 rounded">MC</span>
                                </div>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                    <input type="text" placeholder="1234 5678 9012 3456" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                        <input type="text" placeholder="MM/YY" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                        <input type="text" placeholder="123" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-purple-300 transition-colors cursor-pointer">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="payment" id="cod" class="w-5 h-5 text-purple-600">
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

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                            <img src="{{ asset('images/dog_food1.jpg') }}" alt="Product" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Pedigree Puppy</p>
                                <p class="text-sm text-gray-600">Qty: 2</p>
                            </div>
                            <span class="font-semibold text-gray-800">Rs. 3,000</span>
                        </div>
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                            <img src="{{ asset('images/catfood1.jpg') }}" alt="Product" class="w-16 h-16 object-cover rounded-lg">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Whiskas Cat Food</p>
                                <p class="text-sm text-gray-600">Qty: 1</p>
                            </div>
                            <span class="font-semibold text-gray-800">Rs. 850</span>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rs. 3,850.00</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span>Rs. 308.00</span>
                        </div>
                        <div class="pt-4 border-t border-gray-200 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span class="text-purple-600">Rs. 4,158.00</span>
                        </div>
                    </div>

                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-4">
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
    </div>
</div>
@endsection

