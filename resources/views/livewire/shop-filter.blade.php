<div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
      
      <!-- Sidebar Filters -->
      <aside class="w-full lg:w-1/4 space-y-8">
        <div>
          <h2 class="text-xl font-bold text-gray-900 mb-6 font-heading">Filter Options</h2>
          
          <!-- Search -->
          <div class="mb-8">
             <div class="relative">
               <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
               <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
             </div>
          </div>

          <!-- Pet Type Filter -->
          <div class="border-b border-gray-100 pb-6">
            <h3 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wide">Pet Type</h3>
            <div class="space-y-2">
              @foreach(['Dog', 'Cat'] as $type)
              <label class="flex items-center group cursor-pointer">
                <div class="relative flex items-center">
                  <input type="radio" wire:model.live="pet_type" value="{{ $type }}" class="peer h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                </div>
                <span class="ml-3 text-gray-600 group-hover:text-blue-600 transition-colors text-sm font-medium">{{ $type }}</span>
              </label>
              @endforeach
            </div>
          </div>

          <!-- Category Filter -->
          <div class="border-b border-gray-100 pb-6">
            <h3 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wide">Category</h3>
            <div class="space-y-2">
              @foreach(['Food', 'Toy'] as $category)
              <label class="flex items-center group cursor-pointer">
                <div class="relative flex items-center">
                  <input type="radio" wire:model.live="accessories_type" value="{{ $category }}" class="peer h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                </div>
                <span class="ml-3 text-gray-600 group-hover:text-blue-600 transition-colors text-sm font-medium">{{ $category }}</span>
              </label>
              @endforeach
            </div>
          </div>

          <!-- Price Filter -->
          <div class="pb-6">
            <h3 class="font-bold text-gray-800 mb-4 text-sm uppercase tracking-wide">Price Range</h3>
            <div class="flex items-center gap-2">
               <div class="relative">
                 <span class="absolute left-3 top-2.5 text-gray-400 text-xs">Rs.</span>
                 <input wire:model.live.debounce.500ms="min_price" type="number" class="w-full pl-8 pr-2 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Min">
               </div>
               <span class="text-gray-400">-</span>
               <div class="relative">
                 <span class="absolute left-3 top-2.5 text-gray-400 text-xs">Rs.</span>
                 <input wire:model.live.debounce.500ms="max_price" type="number" class="w-full pl-8 pr-2 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Max">
               </div>
            </div>
          </div>
          
          @if($activeFiltersCount > 0)
          <button wire:click="clearFilters" class="text-sm text-red-500 hover:text-red-700 font-semibold flex items-center gap-1">
             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
             Clear All Filters
          </button>
          @endif
        </div>
      </aside>

      <!-- Main Content -->
      <main class="w-full lg:w-3/4">
        <!-- Top Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
           <div class="text-gray-500 text-sm font-medium">
             Showing <span class="text-gray-900 font-bold">{{ $products->count() }}</span> results
           </div>
           
           <!-- Sort Dropdown (Visual Only) -->
           <div class="flex items-center gap-2">
             <span class="text-sm text-gray-500">Sort by:</span>
             <select class="border-none bg-transparent text-sm font-bold text-gray-700 focus:ring-0 cursor-pointer pr-8 bg-none">
                <option>Default Sorting</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
             </select>
           </div>
        </div>

        <!-- Active Pins -->
        @if($activeFiltersCount > 0)
        <div class="flex flex-wrap gap-2 mb-6">
           @if($pet_type)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
               {{ $pet_type }}
               <button wire:click="$set('pet_type', '')" class="ml-2 focus:outline-none text-green-600 hover:text-green-900">&times;</button>
            </span>
           @endif
           @if($accessories_type)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
               {{ $accessories_type }}
               <button wire:click="$set('accessories_type', '')" class="ml-2 focus:outline-none text-green-600 hover:text-green-900">&times;</button>
            </span>
           @endif
           @if($min_price || $max_price)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
               Price: {{ $min_price ?: '0' }} - {{ $max_price ?: 'Any' }}
               <button wire:click="clearFilters" class="ml-2 focus:outline-none text-green-600 hover:text-green-900">&times;</button>
            </span>
           @endif
        </div>
        @endif

        <!-- Product Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($products as $product)
            <div wire:key="product-{{ $product->id }}" class="group bg-white rounded-2xl p-4 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300 flex flex-col h-full text-center relative overflow-hidden">
               
               <!-- Favorite Button (Absolute Top Right) -->
               <button 
                  type="button"
                  class="favorite-btn absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors"
                  data-pet-id="{{ $product->id }}"
                  data-favorited="{{ in_array($product->id, $favoriteIds) ? '1' : '0' }}"
                  onclick="event.preventDefault(); event.stopPropagation();"
                >
                  <svg class="w-5 h-5" fill="{{ in_array($product->id, $favoriteIds) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
               </button>

               <!-- Image -->
               <div class="relative w-full h-48 mb-4 flex items-center justify-center bg-gray-50 rounded-xl overflow-hidden group-hover:bg-blue-50/30 transition-colors">
                  <a href="{{ route('product.show', $product->id) }}" class="block w-full h-full">
                    <img src="{{ $product->getImageAssetUrl() }}" alt="{{ $product->product_name }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-500 drop-shadow-sm" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                  </a>
               </div>

               <!-- Details -->
               <div class="flex-1 flex flex-col items-center">
                  <a href="{{ route('product.show', $product->id) }}" class="block group-hover:text-blue-600 transition-colors">
                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight">{{ $product->product_name }}</h3>
                  </a>
                  
                  <!-- Original Price (Strike) & Current Price -->
                  <div class="flex items-center gap-2 mb-4">
                     <span class="text-xl font-bold text-gray-900">Rs. {{ number_format((float)$product->price, 2) }}</span>
                  </div>

                  <!-- Ratings (Visual) -->
                  <!-- Removed to cleaner look or add back small? Reference has NO ratings visible on card, just title/price/button. I'll stick to cleaner. -->
                  
                  <!-- Add to Cart Button -->
                  <div class="w-full mt-auto">
                     <form action="{{ route('cart.add') }}" method="POST" class="w-full" onclick="event.stopPropagation()">
                         @csrf
                         <input type="hidden" name="pet_id" value="{{ $product->id }}">
                         <button type="submit" class="w-full h-11 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-4 rounded-xl text-sm font-semibold shadow-sm hover:shadow-md active:shadow-sm transition-all duration-200 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Add to Cart
                        </button>
                     </form>
                  </div>
               </div>
            </div>
          @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
           <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4">
             <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
           </div>
           <h3 class="text-lg font-medium text-gray-900 mb-1">No products found</h3>
           <p class="text-gray-500">Try adjusting your filters or search criteria.</p>
        </div>
        @endif
      </main>
    </div>
  </div>
</div>
