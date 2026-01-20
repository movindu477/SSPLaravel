<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-16 w-auto">
                </a>
            </div>
            
            @guest
            <div class="hidden lg:flex flex-1 justify-center items-center">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('home') ? 'text-blue-700' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('about') ? 'text-blue-700' : '' }}">
                        About Us
                    </a>
                    <a href="{{ route('shop') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('shop') ? 'text-blue-700' : '' }}">
                        Shop
                    </a>
                    <a href="{{ route('cart') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('cart') ? 'text-blue-700' : '' }}">
                        <span>Cart</span>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" data-cart-count>{{ $cartCount }}</span>
                        @else
                            <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center hidden" data-cart-count>0</span>
                        @endif
                    </a>
                </div>
            </div>
            @else
                @if(!Auth::user()->isAdmin())
                <div class="hidden lg:flex flex-1 justify-center items-center">
                    <div class="flex space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('home') ? 'text-blue-700' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('about') ? 'text-blue-700' : '' }}">
                            About Us
                        </a>
                        <a href="{{ route('shop') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('shop') ? 'text-blue-700' : '' }}">
                            Shop
                        </a>
                        <a href="{{ route('cart') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('cart') ? 'text-blue-700' : '' }}">
                            <span>Cart</span>
                            @if(isset($cartCount) && $cartCount > 0)
                                <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center" data-cart-count>{{ $cartCount }}</span>
                            @else
                                <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center hidden" data-cart-count>0</span>
                            @endif
                        </a>
                    </div>
                </div>
                @endif
            @endguest
            
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <a href="{{ route('profile') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 text-sm font-medium transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-700 px-4 py-2 text-sm font-medium transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 text-sm font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                        Register
                    </a>
                @endauth
            </div>
            
            <div class="flex items-center lg:hidden">
                <button type="button" class="relative inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 focus:outline-none transition-all duration-300" @click="open = !open" aria-label="Toggle menu">
                    <svg class="h-7 w-7 transition-all duration-300" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-show="!open" class="transition-all duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" class="transition-all duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu Backdrop -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-out duration-700"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-gradient-to-br from-gray-900/80 to-black/60 z-40 lg:hidden backdrop-blur-md"
         x-cloak
         style="display: none;">
    </div>

    <!-- Mobile Slide Panel -->
    <div class="lg:hidden fixed top-0 left-0 bottom-0 w-80 bg-gradient-to-b from-white to-gray-50 shadow-2xl z-50 overflow-y-auto border-r border-gray-200" 
         x-show="open"
         x-transition:enter="transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)]"
         x-transition:enter-start="-translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="-translate-x-full opacity-0"
         x-cloak 
         style="display: none;">
        
        <!-- Panel Header -->
        <div class="sticky top-0 bg-white/95 backdrop-blur-lg border-b border-gray-200 px-6 py-6 flex items-center justify-between z-10 shadow-sm">
            <div class="flex items-center gap-3 transition-all duration-500 ease-out"
                 x-show="open"
                 x-transition:enter="transition-all delay-300 duration-500 ease-out"
                 x-transition:enter-start="opacity-0 -translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0">
                <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-14 w-auto drop-shadow-sm">
            </div>
            <button @click="open = false" class="p-2.5 hover:bg-gray-100 rounded-xl transition-all duration-300 group">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-900 group-hover:rotate-90 transition-all duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Panel Content -->
        <div class="px-5 pt-8 pb-6 space-y-1"
             x-show="open"
             x-transition:enter="transition-all delay-200 duration-600 ease-out"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            @guest
            <a href="{{ route('home') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('home') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
               x-show="open"
               x-transition:enter="transition-all delay-[350ms] duration-500 ease-out"
               x-transition:enter-start="opacity-0 translate-x-8"
               x-transition:enter-end="opacity-100 translate-x-0">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-11 h-11 rounded-xl {{ request()->routeIs('home') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5 {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        @if(request()->routeIs('home'))
                        <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                        @endif
                    </div>
                    <span class="tracking-tight">Home</span>
                </div>
            </a>
            
            <a href="{{ route('about') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('about') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
               x-show="open"
               x-transition:enter="transition-all delay-[400ms] duration-500 ease-out"
               x-transition:enter-start="opacity-0 translate-x-8"
               x-transition:enter-end="opacity-100 translate-x-0">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-11 h-11 rounded-xl {{ request()->routeIs('about') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                            <svg class="w-5 h-5 {{ request()->routeIs('about') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @if(request()->routeIs('about'))
                        <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                        @endif
                    </div>
                    <span class="tracking-tight">About Us</span>
                </div>
            </a>
            
            <a href="{{ route('shop') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('shop') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
               x-show="open"
               x-transition:enter="transition-all delay-[450ms] duration-500 ease-out"
               x-transition:enter-start="opacity-0 translate-x-8"
               x-transition:enter-end="opacity-100 translate-x-0">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-11 h-11 rounded-xl {{ request()->routeIs('shop') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                            <svg class="w-5 h-5 {{ request()->routeIs('shop') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        @if(request()->routeIs('shop'))
                        <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                        @endif
                    </div>
                    <span class="tracking-tight">Shop</span>
                </div>
            </a>
            
            <a href="{{ route('cart') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('cart') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
               x-show="open"
               x-transition:enter="transition-all delay-[500ms] duration-500 ease-out"
               x-transition:enter-start="opacity-0 translate-x-8"
               x-transition:enter-end="opacity-100 translate-x-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-11 h-11 rounded-xl {{ request()->routeIs('cart') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 {{ request()->routeIs('cart') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            @if(request()->routeIs('cart'))
                            <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                            @endif
                        </div>
                        <span class="tracking-tight">Cart</span>
                    </div>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="bg-gradient-to-br from-gray-800 to-gray-900 text-white text-xs font-bold rounded-full h-7 w-7 flex items-center justify-center shadow-lg border border-gray-700" data-cart-count>{{ $cartCount }}</span>
                    @else
                        <span class="bg-gradient-to-br from-gray-800 to-gray-900 text-white text-xs font-bold rounded-full h-7 w-7 flex items-center justify-center hidden border border-gray-700" data-cart-count>0</span>
                    @endif
                </div>
            </a>
            @else
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('home') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('home') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
                   x-show="open"
                   x-transition:enter="transition-all delay-[350ms] duration-500 ease-out"
                   x-transition:enter-start="opacity-0 translate-x-8"
                   x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-11 h-11 rounded-xl {{ request()->routeIs('home') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 {{ request()->routeIs('home') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            @if(request()->routeIs('home'))
                            <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                            @endif
                        </div>
                        <span class="tracking-tight">Home</span>
                    </div>
                </a>
                
                <a href="{{ route('about') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('about') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
                   x-show="open"
                   x-transition:enter="transition-all delay-[400ms] duration-500 ease-out"
                   x-transition:enter-start="opacity-0 translate-x-8"
                   x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-11 h-11 rounded-xl {{ request()->routeIs('about') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 {{ request()->routeIs('about') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            @if(request()->routeIs('about'))
                            <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                            @endif
                        </div>
                        <span class="tracking-tight">About Us</span>
                    </div>
                </a>
                
                <a href="{{ route('shop') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('shop') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
                   x-show="open"
                   x-transition:enter="transition-all delay-[450ms] duration-500 ease-out"
                   x-transition:enter-start="opacity-0 translate-x-8"
                   x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-11 h-11 rounded-xl {{ request()->routeIs('shop') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 {{ request()->routeIs('shop') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            @if(request()->routeIs('shop'))
                            <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                            @endif
                        </div>
                        <span class="tracking-tight">Shop</span>
                    </div>
                </a>
                
                <a href="{{ route('cart') }}" @click="open = false" class="group relative block px-4 py-4 rounded-2xl text-base font-medium {{ request()->routeIs('cart') ? 'bg-gray-900 text-white shadow-xl' : 'text-gray-700 hover:bg-white hover:shadow-md' }} transition-all duration-500 ease-out"
                   x-show="open"
                   x-transition:enter="transition-all delay-[500ms] duration-500 ease-out"
                   x-transition:enter-start="opacity-0 translate-x-8"
                   x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-11 h-11 rounded-xl {{ request()->routeIs('cart') ? 'bg-white/10' : 'bg-gray-100 group-hover:bg-gray-900' }} flex items-center justify-center transition-all duration-500 ease-out">
                                    <svg class="w-5 h-5 {{ request()->routeIs('cart') ? 'text-white' : 'text-gray-600 group-hover:text-white' }} transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                @if(request()->routeIs('cart'))
                                <div class="absolute -right-1 -top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-900"></div>
                                @endif
                            </div>
                            <span class="tracking-tight">Cart</span>
                        </div>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="bg-gradient-to-br from-gray-800 to-gray-900 text-white text-xs font-bold rounded-full h-7 w-7 flex items-center justify-center shadow-lg border border-gray-700" data-cart-count>{{ $cartCount }}</span>
                        @else
                            <span class="bg-gradient-to-br from-gray-800 to-gray-900 text-white text-xs font-bold rounded-full h-7 w-7 flex items-center justify-center hidden border border-gray-700" data-cart-count>0</span>
                        @endif
                    </div>
                </a>
                @endif
            @endguest
            
            <!-- Divider -->
            <div class="my-6 border-t border-gray-200"
                 x-show="open"
                 x-transition:enter="transition-all delay-[550ms] duration-500 ease-out"
                 x-transition:enter-start="opacity-0 scale-x-0"
                 x-transition:enter-end="opacity-100 scale-x-100"></div>
            
            <!-- Account Section -->
            <div class="space-y-1">
                @auth
                    <a href="{{ route('profile') }}" @click="open = false" class="group block px-4 py-4 rounded-2xl text-base font-medium text-gray-700 hover:bg-white hover:shadow-md transition-all duration-500 ease-out"
                       x-show="open"
                       x-transition:enter="transition-all delay-[600ms] duration-500 ease-out"
                       x-transition:enter-start="opacity-0 translate-x-8"
                       x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-gray-100 group-hover:bg-gray-900 flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="tracking-tight">My Profile</span>
                        </div>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="group block w-full text-left px-4 py-4 rounded-2xl text-base font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-500 ease-out"
                                x-show="open"
                                x-transition:enter="transition-all delay-[650ms] duration-500 ease-out"
                                x-transition:enter-start="opacity-0 translate-x-8"
                                x-transition:enter-end="opacity-100 translate-x-0">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-xl bg-gray-100 group-hover:bg-red-500 flex items-center justify-center transition-all duration-500 ease-out">
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <span class="tracking-tight">Sign Out</span>
                            </div>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="open = false" class="group block px-4 py-4 rounded-2xl text-base font-medium text-gray-700 hover:bg-white hover:shadow-md transition-all duration-500 ease-out"
                       x-show="open"
                       x-transition:enter="transition-all delay-[600ms] duration-500 ease-out"
                       x-transition:enter-start="opacity-0 translate-x-8"
                       x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-gray-100 group-hover:bg-gray-900 flex items-center justify-center transition-all duration-500 ease-out">
                                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-500 ease-out" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <span class="tracking-tight">Sign In</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('register') }}" @click="open = false" class="block px-4 py-4 rounded-2xl text-base font-semibold bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-500 ease-out"
                       x-show="open"
                       x-transition:enter="transition-all delay-[650ms] duration-500 ease-out"
                       x-transition:enter-start="opacity-0 translate-x-8"
                       x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-white/10 backdrop-blur-sm flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <span class="tracking-tight">Create Account</span>
                        </div>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
