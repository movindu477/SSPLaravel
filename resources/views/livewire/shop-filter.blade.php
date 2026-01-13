<div>
  <!-- Filter Section -->
  <section class="w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
          </svg>
          <h2 class="text-lg font-bold text-gray-900">Filters</h2>
          @if($activeFiltersCount > 0)
            <span class="bg-blue-700 text-white text-xs font-semibold px-2 py-0.5 rounded-full">{{ $activeFiltersCount }}</span>
          @endif
        </div>
      </div>
      
      <!-- Livewire Filter Form -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Pet Type</label>
          <select wire:model.live="pet_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-blue-700 bg-white text-gray-900 transition text-sm min-h-[40px]">
            <option value="">All Pets</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
          </select>
        </div>
        
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Category</label>
          <select wire:model.live="accessories_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-blue-700 bg-white text-gray-900 transition text-sm min-h-[40px]">
            <option value="">All Categories</option>
            <option value="Food">Food</option>
            <option value="Toy">Toy</option>
          </select>
        </div>
        
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Price Range</label>
          <div class="flex space-x-2">
            <input wire:model.live.debounce.300ms="min_price" type="number" placeholder="Min" min="0" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-blue-700 text-gray-900 text-sm min-h-[40px]" />
            <input wire:model.live.debounce.300ms="max_price" type="number" placeholder="Max" min="0" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-blue-700 text-gray-900 text-sm min-h-[40px]" />
          </div>
        </div>
        
        <div class="lg:col-span-2">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Search</label>
          <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search products..." autocomplete="off" class="w-full px-3 py-2 pl-9 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-blue-700 text-gray-900 transition text-sm min-h-[40px]" />
            <svg class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>
        
        <div class="lg:col-span-5 flex justify-end space-x-2">
          <button wire:click="clearFilters" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
            Clear All
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section id="products" class="py-8 sm:py-12 px-4 sm:px-6 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-6 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Our Products</h2>
        <p class="text-gray-600 text-base sm:text-lg">Browse our collection of premium pet products</p>
      </div>

      @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
          @foreach($products as $product)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300 cursor-pointer">
              <!-- Product Image - Clickable -->
              <a href="{{ route('product.show', $product->id) }}" class="block relative h-48 sm:h-56 bg-gray-100 overflow-hidden">
                <img src="{{ $product->getImageAssetUrl() }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                
                <!-- Badge -->
                <div class="absolute top-3 left-3 bg-blue-700 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-sm">
                  {{ $product->pet_type }}
                </div>
              </a>
              
              <!-- Product Info -->
              <div class="p-5 bg-white">
                <!-- Category Badge -->
                <div class="mb-3">
                  <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-md mb-2">
                    {{ $product->accessories_type }}
                  </span>
                </div>
                
                <!-- Product Name - Clickable -->
                <a href="{{ route('product.show', $product->id) }}" class="block">
                  <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem] hover:text-blue-700 transition">
                    {{ $product->product_name }}
                  </h3>
                </a>
                
                <!-- Rating -->
                <div class="flex items-center gap-2 mb-4">
                  <div class="flex text-yellow-400">
                    @for($i = 0; $i < 5; $i++)
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                      </svg>
                    @endfor
                  </div>
                  <span class="text-sm text-gray-700 font-medium">4.5</span>
                  <span class="text-xs text-gray-500">(128)</span>
                </div>
                
                <!-- Price and Action Buttons -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                  <!-- Price -->
                  <span class="text-2xl font-bold text-blue-700">
                    Rs. {{ number_format((float)$product->price, 2) }}
                  </span>

                  <!-- Action Buttons -->
                  <div class="flex items-center gap-3" onclick="event.stopPropagation()">
                    <!-- Favorite -->
                    <button 
                        class="favorite-btn flex items-center justify-center"
                        data-pet-id="{{ $product->id }}"
                        data-favorited="{{ in_array($product->id, $favoriteIds) ? '1' : '0' }}"
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

                    <!-- Add to Cart -->
                    <form action="{{ route('cart.add') }}" method="POST" class="inline-block">
                        @csrf
                        <input type="hidden" name="pet_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold">
                            Add
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
