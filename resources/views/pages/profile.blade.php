@extends('layouts.app')

@section('title', 'Profile - PetMart')

@section('content')
@if(!session('user_id'))
    <div class="min-h-screen bg-gray-50 py-12 flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Please Login</h2>
            <p class="text-gray-600 mb-6">You need to be logged in to view your profile.</p>
            <a href="{{ route('login') }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300">
                Go to Login
            </a>
        </div>
    </div>
@else
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-600 to-blue-600 h-32"></div>
            
            <div class="px-8 pb-8 -mt-16">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                    <div class="relative">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <button class="absolute bottom-0 right-0 bg-cyan-600 text-white rounded-full p-2 hover:bg-cyan-700 transition-colors shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ session('user_name', $user->name ?? 'Guest User') }}</h1>
                        <p class="text-gray-600 mb-4">{{ session('user_email', $user->email ?? 'No email') }}</p>
                        <div class="flex flex-wrap gap-4">
                            <span class="bg-cyan-100 text-cyan-700 px-4 py-1 rounded-full text-sm font-medium">
                                {{ ucfirst(session('user_role', $user->role ?? 'user')) }}
                            </span>
                            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium">Verified</span>
                        </div>
                    </div>
                    <button class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Edit Profile
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-lg p-6 border border-cyan-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Total Orders</h3>
                            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-cyan-600">24</p>
                        <p class="text-sm text-gray-600 mt-2">All time purchases</p>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border border-green-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Total Spent</h3>
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-green-600">Rs. 45,000</p>
                        <p class="text-sm text-gray-600 mt-2">Lifetime value</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Reward Points</h3>
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-blue-600">1,250</p>
                        <p class="text-sm text-gray-600 mt-2">Available points</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ session('user_name', $user->name ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ session('user_email', $user->email ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ session('user_phone', $user->phonenumber ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    <span class="inline-block bg-cyan-100 text-cyan-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ ucfirst(session('user_role', $user->role ?? 'user')) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 min-h-[80px]">
                                {{ session('user_address', $user->address ?? 'No address provided') }}
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('shop') }}" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-lg font-semibold text-center transform hover:scale-105 transition-all duration-300">
                                Continue Shopping
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

