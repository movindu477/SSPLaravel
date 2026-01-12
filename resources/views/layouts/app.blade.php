<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PetMart - Your Pet Store')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            transition: all 0.3s ease;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        .js-enabled {
            /* JavaScript enabled styles */
        }
        .page-transition {
            animation: fadeIn 0.4s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg sticky top-0 z-50 backdrop-blur-sm bg-white/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ session('user_role') === 'admin' ? route('admin.dashboard') : route('home') }}" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-12 w-auto transition-transform duration-300 group-hover:scale-110">
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-700 to-blue-800 bg-clip-text text-transparent">PetMart</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    @if(session('user_role') === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.*') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('admin.products') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.products') || request()->routeIs('admin.create-product') || request()->routeIs('admin.edit-product') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Products</span>
                        </a>
                        <a href="{{ route('admin.users') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.users') || request()->routeIs('admin.create-user') || request()->routeIs('admin.edit-user') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>Users</span>
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Home</span>
                        </a>
                        <a href="{{ route('shop') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('shop') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Shop</span>
                        </a>
                        <a href="{{ route('about') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('about') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>About</span>
                        </a>
                        <a href="{{ route('cart') }}" class="nav-link flex items-center space-x-1.5 px-4 py-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 relative {{ request()->routeIs('cart') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Cart</span>
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-blue-700 to-blue-800 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center shadow-lg">0</span>
                        </a>
                    @endif
                </div>

                <!-- Right Side Actions -->
                <div class="hidden lg:flex items-center space-x-3">
                    @if(session('user_id'))
                        <span class="text-sm text-gray-600">Welcome, {{ session('user_name') }}</span>
                        @if(session('user_role') === 'admin')
                            <a href="{{ route('admin.profile') }}" class="p-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300" title="Profile">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('profile') }}" class="p-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300" title="Profile">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium transition-colors duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-700 to-blue-800 hover:from-blue-800 hover:to-blue-900 text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            Sign Up
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-btn" class="p-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-gray-200 mt-2">
                <div class="flex flex-col space-y-1 pt-4">
                    @if(session('user_role') === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('admin.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.products') || request()->routeIs('admin.create-product') || request()->routeIs('admin.edit-product') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Products</span>
                        </a>
                        <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.users') || request()->routeIs('admin.create-user') || request()->routeIs('admin.edit-user') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>Users</span>
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Home</span>
                        </a>
                        <a href="{{ route('shop') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('shop') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Shop</span>
                        </a>
                        <a href="{{ route('about') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('about') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>About</span>
                        </a>
                        <a href="{{ route('cart') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 relative {{ request()->routeIs('cart') ? 'text-blue-700 bg-blue-50' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Cart</span>
                            <span class="absolute left-10 top-3 bg-gradient-to-r from-blue-700 to-blue-800 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </a>
                    @endif
                    @if(session('user_id'))
                        @if(session('user_role') === 'admin')
                            <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('admin.profile') ? 'text-blue-700 bg-blue-50' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profile</span>
                            </a>
                        @else
                            <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 {{ request()->routeIs('profile') ? 'text-blue-700 bg-blue-50' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profile</span>
                            </a>
                        @endif
                    @endif
                    <div class="border-t border-gray-200 pt-4 mt-2">
                        @if(session('user_id'))
                            <div class="px-4 py-2 text-sm text-gray-600 mb-2">
                                Welcome, {{ session('user_name') }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="px-4">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300 text-left">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 font-medium transition-all duration-300">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="block mx-4 mt-2 bg-gradient-to-r from-blue-700 to-blue-800 hover:from-blue-800 hover:to-blue-900 text-white px-6 py-3 rounded-lg font-semibold text-center shadow-md transition-all duration-300">
                                Sign Up
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="page-transition">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">PetMart</h3>
                    <p class="text-gray-400">Your one-stop shop for all pet needs. Quality products for your furry friends.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="hover:text-white">Shop</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-white">Returns</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:opacity-80">
                            <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="h-6 w-6">
                        </a>
                        <a href="#" class="hover:opacity-80">
                            <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="h-6 w-6">
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PetMart. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scroll-to-top" class="fixed bottom-6 right-6 bg-gradient-to-r from-blue-700 to-blue-800 hover:from-blue-800 hover:to-blue-900 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 opacity-0 pointer-events-none z-50" aria-label="Scroll to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuBtn?.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.add('opacity-100');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                scrollToTopBtn.classList.remove('opacity-100');
            }
        });

        // Scroll to top when button is clicked
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>

