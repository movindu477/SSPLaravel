<div>
  <!-- Filter Section -->
  <section class="w-full bg-gradient-to-b from-white to-gray-50 border-b border-gray-200 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-md">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
          </div>
          <h2 class="text-xl font-bold text-gray-900">Filter Products</h2>
          @if($activeFiltersCount > 0)
            <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md animate-pulse">{{ $activeFiltersCount }} Active</span>
          @endif
        </div>
      </div>
      
      <!-- Livewire Filter Form -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="lg:col-span-1">
          <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Pet Type</label>
          <select wire:model.live="pet_type" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-white text-gray-900 transition-all text-sm font-medium shadow-sm hover:border-blue-400">
            <option value="">All Pets</option>
            <option value="Dog">🐕 Dog</option>
            <option value="Cat">🐱 Cat</option>
          </select>
        </div>
        
        <div class="lg:col-span-1">
          <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Category</label>
          <select wire:model.live="accessories_type" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 bg-white text-gray-900 transition-all text-sm font-medium shadow-sm hover:border-blue-400">
            <option value="">All Categories</option>
            <option value="Food">🍖 Food</option>
            <option value="Toy">🎾 Toy</option>
          </select>
        </div>
        
        <div class="lg:col-span-1">
          <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Price Range</label>
          <div class="flex space-x-2">
            <input wire:model.live.debounce.300ms="min_price" type="number" placeholder="Min" min="0" class="w-1/2 px-3 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-gray-900 text-sm font-medium shadow-sm hover:border-blue-400 transition-all" />
            <input wire:model.live.debounce.300ms="max_price" type="number" placeholder="Max" min="0" class="w-1/2 px-3 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-gray-900 text-sm font-medium shadow-sm hover:border-blue-400 transition-all" />
          </div>
        </div>
        
        <div class="lg:col-span-2">
          <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Search Products</label>
          <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search by name..." autocomplete="off" class="w-full px-4 py-3 pl-11 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 text-gray-900 transition-all text-sm font-medium shadow-sm hover:border-blue-400" />
            <svg class="absolute left-3.5 top-3.5 w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>
        
        <div class="lg:col-span-5 flex justify-end space-x-2 pt-2">
          <button wire:click="clearFilters" type="button" class="px-6 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Clear All Filters
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section id="products" class="py-8 sm:py-12 px-4 sm:px-6 bg-gradient-to-b from-gray-50 to-white scroll-mt-20">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-8 sm:mb-12">
        <div class="inline-block mb-4">
          <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-bold px-6 py-2.5 rounded-full shadow-xl uppercase tracking-wider">Premium Collection</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900 bg-clip-text text-transparent mb-3 sm:mb-4">Our Products</h2>
        <p class="text-gray-600 text-base sm:text-lg font-medium max-w-2xl mx-auto">Discover our handpicked collection of premium pet products designed for your furry friends</p>
      </div>

      @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
          @foreach($products as $product)
            <div class="group bg-white rounded-lg overflow-hidden border border-gray-200 hover:border-blue-400 hover:shadow-xl transition-all duration-300 flex flex-col h-full">
              <!-- Product Image Area - Fixed Height -->
              <div class="relative h-56 bg-gray-50 overflow-hidden flex-shrink-0">
                <!-- Product Image - Clickable -->
                <a href="{{ route('product.show', $product->id) }}" class="block relative h-full">
                  <img src="{{ $product->getImageAssetUrl() }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                  
                  <!-- Pet Type Badge -->
                  <div class="absolute top-2.5 left-2.5 bg-blue-600 text-white text-xs font-semibold px-2.5 py-1 rounded shadow-sm">
                    {{ $product->pet_type }}
                  </div>
                </a>

                <!-- Favorite Button (top-right corner) - Perfectly Round -->
                <button 
                    type="button"
                    class="favorite-btn absolute top-2.5 right-2.5 z-10 w-9 h-9 bg-white rounded-full shadow-md flex items-center justify-center hover:shadow-lg hover:scale-110 transition-all duration-200"
                    data-pet-id="{{ $product->id }}"
                    data-favorited="{{ in_array($product->id, $favoriteIds) ? '1' : '0' }}"
                    onclick="event.preventDefault(); event.stopPropagation();"
                    aria-label="Toggle favorite"
                >
                    <svg class="w-4.5 h-4.5"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         style="{{ in_array($product->id, $favoriteIds) ? 'stroke:#ef4444;fill:#ef4444;' : 'stroke:#6b7280;fill:none;' }}"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
              </div>
              
              <!-- Product Info - Flexible Section with Fixed Bottom -->
              <div class="flex flex-col flex-1 p-4">
                <!-- Category Badge - Fixed Height -->
                <div class="h-6 mb-2 flex items-start">
                  <span class="inline-block bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-1 rounded">
                    {{ $product->accessories_type }}
                  </span>
                </div>

                <!-- Product Name - Fixed 2-line Height -->
                <a href="{{ route('product.show', $product->id) }}" class="block mb-2.5">
                  <h3 class="text-sm font-semibold text-gray-900 line-clamp-2 leading-tight group-hover:text-blue-600 transition-colors duration-200 h-10">
                    {{ $product->product_name }}
                  </h3>
                </a>
                
                <!-- Rating - Fixed Height -->
                <div class="flex items-center gap-1.5 h-5 mb-3">
                  <div class="flex text-amber-400">
                    @for($i = 0; $i < 5; $i++)
                      <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                    @endfor
                  </div>
                  <span class="text-xs text-gray-600 font-medium">4.5</span>
                  <span class="text-xs text-gray-400">(128)</span>
                </div>
                
                <!-- Price and Button Section - Pushed to Bottom -->
                <div class="mt-auto">
                  <!-- Price - Fixed Height -->
                  <div class="h-8 mb-3 flex items-center">
                    <span class="text-xl font-bold text-gray-900">
                      Rs. {{ number_format((float)$product->price, 2) }}
                    </span>
                  </div>

                  <!-- Buttons Row - Favorite and Add to Cart -->
                  <div class="flex gap-2">
                    <!-- Favorite Button - Wider and More Rounded -->
                    <button 
                        type="button"
                        class="favorite-btn flex-shrink-0 w-14 h-11 bg-white border-2 border-gray-300 hover:border-red-400 rounded-xl flex items-center justify-center hover:bg-red-50 transition-all duration-200"
                        data-pet-id="{{ $product->id }}"
                        data-favorited="{{ in_array($product->id, $favoriteIds) ? '1' : '0' }}"
                        onclick="event.preventDefault(); event.stopPropagation();"
                        aria-label="Toggle favorite"
                    >
                        <svg class="w-5 h-5"
                             viewBox="0 0 24 24"
                             stroke-width="2"
                             style="{{ in_array($product->id, $favoriteIds) ? 'stroke:#ef4444;fill:#ef4444;' : 'stroke:#6b7280;fill:none;' }}"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>

                    <!-- Add to Cart Button - Flexible Width -->
                    <form action="{{ route('cart.add') }}" method="POST" class="flex-1" onclick="event.stopPropagation()">
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
            </div>
          @endforeach
        </div>
      @else
        <div class="col-span-full text-center py-12">
          <p class="text-gray-600 text-lg mb-4">No products found. Try adjusting your filters.</p>
          @if($activeFiltersCount > 0)
            <button wire:click="clearFilters" class="text-blue-700 hover:text-blue-800 font-semibold">Clear all filters</button>
          @endif
        </div>
      @endif
    </div>
  </section>
</div>
