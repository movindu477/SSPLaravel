<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-16 w-auto">
                </a>
            </div>
            
            <div class="hidden lg:flex flex-1 justify-center items-center">
                <div class="flex space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('admin.dashboard') ? 'text-blue-700' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('admin.products') || request()->routeIs('admin.create-product') || request()->routeIs('admin.edit-product') ? 'text-blue-700' : '' }}">
                        Manage Products
                    </a>
                    <a href="{{ route('admin.users') }}" class="text-gray-700 hover:text-blue-700 font-medium transition duration-150 ease-in-out {{ request()->routeIs('admin.users') || request()->routeIs('admin.create-user') || request()->routeIs('admin.edit-user') ? 'text-blue-700' : '' }}">
                        Manage Users
                    </a>
                </div>
            </div>
            
            <div class="hidden lg:flex items-center space-x-4">
                @auth
                    <a href="{{ route('admin.profile') }}" class="text-gray-700 hover:text-blue-700 px-4 py-2 text-sm font-medium transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-700 px-4 py-2 text-sm font-medium transition">
                            Logout
                        </button>
                    </form>
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
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                Dashboard
            </a>
            <a href="{{ route('admin.products') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.products') || request()->routeIs('admin.create-product') || request()->routeIs('admin.edit-product') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                Manage Products
            </a>
            <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.users') || request()->routeIs('admin.create-user') || request()->routeIs('admin.edit-user') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-700' }} transition">
                Manage Users
            </a>
            <div class="border-t border-gray-200 pt-2 mt-2">
                @auth
                    <a href="{{ route('admin.profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-700 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
