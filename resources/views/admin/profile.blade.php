@extends('layouts.app')

@section('title', 'Admin Profile - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-600 to-blue-600 h-32"></div>
            
            <div class="px-8 pb-8 -mt-16">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                    <div class="relative">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $user->name }}</h1>
                        <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                        <div class="flex flex-wrap gap-4">
                            <span class="bg-cyan-100 text-cyan-700 px-4 py-1 rounded-full text-sm font-medium">
                                Admin
                            </span>
                            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-medium">Verified</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Information</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    {{ $user->phonenumber ?? 'N/A' }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
                                    <span class="inline-block bg-cyan-100 text-cyan-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ ucfirst($user->role ?? 'admin') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <div class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 min-h-[80px]">
                                {{ $user->address ?? 'No address provided' }}
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-lg font-semibold text-center transform hover:scale-105 transition-all duration-300">
                                Back to Dashboard
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
@endsection

