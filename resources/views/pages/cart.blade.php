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
                        <span class="text-gray-600">3 items</span>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-6 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="relative w-24 h-24 flex-shrink-0">
                                <img src="{{ asset('images/dog_food1.jpg') }}" alt="Premium Dog Food" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">Pedigree Puppy Chicken & Milk</h3>
                                <p class="text-sm text-gray-600 mb-2">Dog - Food</p>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button class="px-3 py-1 hover:bg-gray-100 transition-colors">-</button>
                                        <span class="px-4 py-1 border-x border-gray-300">2</span>
                                        <button class="px-3 py-1 hover:bg-gray-100 transition-colors">+</button>
                                    </div>
                                    <span class="text-lg font-bold text-purple-600">Rs. 1,500.00</span>
                                </div>
                            </div>
                            <button class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-6 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="relative w-24 h-24 flex-shrink-0">
                                <img src="{{ asset('images/catfood1.jpg') }}" alt="Healthy Cat Food" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">Whiskas Chicken Dry Food 1kg</h3>
                                <p class="text-sm text-gray-600 mb-2">Cat - Food</p>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button class="px-3 py-1 hover:bg-gray-100 transition-colors">-</button>
                                        <span class="px-4 py-1 border-x border-gray-300">1</span>
                                        <button class="px-3 py-1 hover:bg-gray-100 transition-colors">+</button>
                                    </div>
                                    <span class="text-lg font-bold text-purple-600">Rs. 850.00</span>
                                </div>
                            </div>
                            <button class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('shop') }}" class="text-purple-600 hover:text-purple-700 font-semibold flex items-center gap-2">
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

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Enter code" 
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-semibold transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('payment') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center py-4 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg mb-4">
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
@endsection

