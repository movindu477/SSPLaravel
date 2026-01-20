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
          <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase tracking-wider">Premium Collection</span>
        </div>
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold bg-gradient-to-r from-gray-900 via-blue-900 to-gray-900 bg-clip-text text-transparent mb-3 sm:mb-4">Our Products</h2>
        <p class="text-gray-600 text-base sm:text-lg font-medium max-w-2xl mx-auto">Discover our handpicked collection of premium pet products designed for your furry friends</p>
      </div>

      @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
          @foreach($products as $product)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 cursor-pointer backdrop-blur-sm">
              <!-- Product Image - Clickable -->
              <a href="{{ route('product.show', $product->id) }}" class="block relative h-64 sm:h-72 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                <img src="{{ $product->getImageAssetUrl() }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <!-- Pet Type Badge -->
                <div class="absolute top-4 left-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">
                  {{ $product->pet_type }}
                </div>

                <!-- Category Badge -->
                <div class="absolute top-4 right-4">
                  <span class="inline-block bg-white/90 backdrop-blur-sm text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-md border border-blue-100">
                    {{ $product->accessories_type }}
                  </span>
                </div>

                <!-- Favorite Button - On Image -->
                <button 
                    class="favorite-btn absolute bottom-4 right-4 w-11 h-11 bg-white/95 backdrop-blur-sm rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition-all duration-300 border border-gray-100"
                    data-pet-id="{{ $product->id }}"
                    data-favorited="{{ in_array($product->id, $favoriteIds) ? '1' : '0' }}"
                    onclick="event.preventDefault(); event.stopPropagation();"
                >
                    <svg class="w-6 h-6 {{ in_array($product->id, $favoriteIds) ? 'text-red-500' : 'text-gray-400' }}"
                         fill="{{ in_array($product->id, $favoriteIds) ? 'currentColor' : 'none' }}"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
              </a>
              
              <!-- Product Info -->
              <div class="p-6 bg-gradient-to-b from-white to-gray-50/50">
                <!-- Product Name - Clickable -->
                <a href="{{ route('product.show', $product->id) }}" class="block mb-3">
                  <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem] group-hover:text-blue-700 transition-colors duration-300">
                    {{ $product->product_name }}
                  </h3>
                </a>
                
                <!-- Rating -->
                <div class="flex items-center gap-2 mb-4">
                  <div class="flex text-amber-400">
                    @for($i = 0; $i < 5; $i++)
                      <svg class="w-4 h-4 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                    @endfor
                  </div>
                  <span class="text-sm text-gray-700 font-semibold">4.5</span>
                  <span class="text-xs text-gray-500">(128 reviews)</span>
                </div>
                
                <!-- Price and Add Button -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200/50">
                  <!-- Price -->
                  <div class="flex flex-col">
                    <span class="text-xs text-gray-500 font-medium">Price</span>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">
                      Rs. {{ number_format((float)$product->price, 2) }}
                    </span>
                  </div>

                  <!-- Add to Cart Button -->
                  <form action="{{ route('cart.add') }}" method="POST" class="inline-block" onclick="event.stopPropagation()">
                      @csrf
                      <input type="hidden" name="pet_id" value="{{ $product->id }}">
                      <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                          </svg>
                          Add
                      </button>
                  </form>
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
