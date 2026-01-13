@extends('layouts.app')

@section('title', 'Register - PetMart')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-20 w-auto">
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <a href="{{ route('login') }}" class="font-medium text-blue-700 hover:text-blue-800">
                    sign in to your existing account
                </a>
            </p>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Enter your full name" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Enter your email" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="phonenumber" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input id="phonenumber" name="phonenumber" type="text" autocomplete="tel" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Enter your phone number" value="{{ old('phonenumber') }}">
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input id="address" name="address" type="text" autocomplete="street-address" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Enter your address" value="{{ old('address') }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Enter your password">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                           class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-700 focus:border-blue-700 focus:z-10 sm:text-sm" 
                           placeholder="Confirm your password">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 transition duration-150">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
