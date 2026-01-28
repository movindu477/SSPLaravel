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
    
    <!-- Mobile Menu Media Query Restraint -->
    <div class="lg:hidden">
        <!-- Backdrop -->
        <div x-show="open" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="open = false"
             class="fixed inset-0 bg-black bg-opacity-50 z-40"
             style="display: none;">
        </div>

        <!-- Panel -->
        <!-- Panel -->
        <div x-show="open"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed inset-y-0 right-0 z-50 bg-white shadow-xl overflow-y-auto"
             style="width: 85%; max-width: 400px; display: none;">
             
             <!-- Header -->
             <div class="flex items-center justify-between px-6 pt-5 pb-5 border-b border-gray-100 bg-white">
                <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-10 w-auto">
                <button @click="open = false" type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none p-2 rounded-md hover:bg-gray-50 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
             </div>

             <!-- Links -->
             <div class="px-4 py-6 space-y-2">
                @guest
                    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        About Us
                    </a>
                    <a href="{{ route('shop') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('shop') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        Shop
                    </a>
                    <a href="{{ route('cart') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('cart') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <div class="flex items-center justify-between">
                            <span>Cart</span>
                            @if(isset($cartCount) && $cartCount > 0)
                                <span class="bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                            @endif
                        </div>
                    </a>
                @else
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            Home
                        </a>
                        <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            About Us
                        </a>
                        <a href="{{ route('shop') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('shop') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            Shop
                        </a>
                        <a href="{{ route('cart') }}" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->routeIs('cart') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <div class="flex items-center justify-between">
                                <span>Cart</span>
                                @if(isset($cartCount) && $cartCount > 0)
                                    <span class="bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                                @endif
                            </div>
                        </a>
                    @endif
                @endguest

                <div class="border-t border-gray-100 my-4 pt-4"></div>

                @auth
                    <a href="{{ route('profile') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50">
                        My Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 rounded-xl text-base font-medium text-red-600 hover:bg-red-50">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-gray-700 hover:bg-gray-50">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl text-base font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 mt-2">
                        Create Account
                    </a>
                @endauth
             </div>
        </div>
    </div>
</nav>
