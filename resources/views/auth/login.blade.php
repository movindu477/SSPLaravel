@extends('layouts.app')

@section('title', 'Login - PetMart')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-gray-50 py-6 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="max-w-4xl w-full">
        <!-- Container with sliding forms -->
        <div class="relative overflow-hidden">
            <!-- Sliding wrapper -->
            <div id="formSlider" class="flex transition-transform duration-700 ease-in-out" style="transform: translateX(0%);">
                
                <!-- Login Form -->
                <div class="w-full flex-shrink-0 px-2">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-gray-100">
                        <!-- Logo -->
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-14 w-auto">
                        </div>
                        
                        <h2 class="text-center text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                            Welcome Back
                        </h2>
                        <p class="text-center text-sm text-gray-600 mb-6">
                            Sign in to your account
                        </p>
                        
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg mb-4 text-sm">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-lg mb-4 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                       placeholder="Enter your email" value="{{ old('email') }}">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                       placeholder="Enter your password">
                            </div>

                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-600 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                Sign In
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Don't have an account? 
                                <button onclick="slideToRegister()" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                    Create Account
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="w-full flex-shrink-0 px-2">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-gray-100">
                        <!-- Logo -->
                        <div class="flex justify-center mb-4">
                            <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-14 w-auto">
                        </div>
                        
                        <h2 class="text-center text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                            Create Account
                        </h2>
                        <p class="text-center text-sm text-gray-600 mb-6">
                            Join PetMart today
                        </p>

                        <form method="POST" action="{{ route('register') }}" class="space-y-3">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div>
                                    <label for="reg_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input id="reg_name" name="name" type="text" autocomplete="name" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Your name" value="{{ old('name') }}">
                                </div>

                                <div>
                                    <label for="reg_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input id="reg_email" name="email" type="email" autocomplete="email" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Your email" value="{{ old('email') }}">
                                </div>

                                <div>
                                    <label for="reg_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input id="reg_phone" name="phonenumber" type="text" autocomplete="tel" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Phone number" value="{{ old('phonenumber') }}">
                                </div>

                                <div>
                                    <label for="reg_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input id="reg_address" name="address" type="text" autocomplete="street-address" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Your address" value="{{ old('address') }}">
                                </div>

                                <div>
                                    <label for="reg_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input id="reg_password" name="password" type="password" autocomplete="new-password" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Create password">
                                </div>

                                <div>
                                    <label for="reg_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                    <input id="reg_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all text-sm" 
                                           placeholder="Confirm password">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg mt-4">
                                Create Account
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Already have an account? 
                                <button onclick="slideToLogin()" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                    Sign In
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Connecting Line Indicator -->
        <div class="flex justify-center mt-6 gap-2">
            <div id="loginDot" class="w-2.5 h-2.5 rounded-full bg-blue-600 transition-all duration-300"></div>
            <div id="registerDot" class="w-2.5 h-2.5 rounded-full bg-gray-300 transition-all duration-300"></div>
        </div>
    </div>
</div>

<script>
    let currentForm = 'login'; // 'login' or 'register'

    function slideToRegister() {
        const slider = document.getElementById('formSlider');
        const loginDot = document.getElementById('loginDot');
        const registerDot = document.getElementById('registerDot');
        
        slider.style.transform = 'translateX(-100%)';
        currentForm = 'register';
        
        // Update dots
        loginDot.classList.remove('bg-blue-600');
        loginDot.classList.add('bg-gray-300');
        registerDot.classList.remove('bg-gray-300');
        registerDot.classList.add('bg-blue-600');
    }

    function slideToLogin() {
        const slider = document.getElementById('formSlider');
        const loginDot = document.getElementById('loginDot');
        const registerDot = document.getElementById('registerDot');
        
        slider.style.transform = 'translateX(0%)';
        currentForm = 'login';
        
        // Update dots
        loginDot.classList.remove('bg-gray-300');
        loginDot.classList.add('bg-blue-600');
        registerDot.classList.remove('bg-blue-600');
        registerDot.classList.add('bg-gray-300');
    }

    // If there are validation errors, show the appropriate form
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any() && old('name'))
            slideToRegister();
        @endif
    });
</script>
@endsection
