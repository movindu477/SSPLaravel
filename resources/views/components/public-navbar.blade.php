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
                            <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
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
                                <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
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
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out" @click="open = !open" aria-label="Toggle menu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <div class="lg:hidden border-t border-gray-200" x-show="open" x-cloak style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @guest
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                Home
            </a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                About Us
            </a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('shop') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                Shop
            </a>
            <a href="{{ route('cart') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cart') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                <span>Cart</span>
                @if(isset($cartCount) && $cartCount > 0)
                    <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
            @else
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                    Home
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                    About Us
                </a>
                <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('shop') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                    Shop
                </a>
                <a href="{{ route('cart') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cart') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                    <span>Cart</span>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="bg-blue-700 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>
                @endif
            @endguest
            <div class="border-t border-gray-200 pt-2 mt-2">
                @auth
                    <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-700 text-white hover:bg-blue-800 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
