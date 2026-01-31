@extends('layouts.app')

@section('title', 'Payment Successful - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 text-center">
            
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                Payment Successful!
            </h2>
            
            @if(isset($order))
                <div class="mt-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <p class="text-blue-700 font-bold">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Confirmed & Paid via Card</p>
                </div>
                
                <div class="mt-6 text-left border-t border-gray-100 pt-6">
                    <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-3">Shipping to:</h4>
                    <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                    <p class="text-sm text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_zip }}</p>
                </div>
            @endif
            
            <p class="mt-6 text-sm text-gray-600">
                Thank you for your purchase. Your order has been placed successfully and is being processed.
            </p>

            <div class="mt-8 space-y-4">
                <a href="{{ route('shop') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Continue Shopping
                </a>
                
                <a href="{{ route('home') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
