@extends('layouts.app')

@section('title', 'Shop - PetMart.LK')

@section('content')
<div class="bg-gray-50">
  <!-- Hero Section -->
  <section class="relative h-screen flex items-center pt-16">
    <img src="{{ asset('images/shop1.jpg') }}" alt="PetMart" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative z-10 flex items-center h-full px-4 sm:px-6 md:px-20">
      <div class="max-w-xl text-left transform opacity-0 -translate-x-10 transition-all duration-1000 ease-out" id="hero-content">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-white mb-4 sm:mb-6 drop-shadow-lg leading-tight">
          Shop Pet Products
        </h1>
        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-100 leading-relaxed drop-shadow-md">
          Discover our wide range of premium pet food, toys, and accessories. Find everything your pet needs in one convenient place.
        </p>
      </div>
    </div>
  </section>

  <!-- Filter Section -->
  <section class="w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
          </svg>
          <h2 class="text-lg font-bold text-gray-900">Filters</h2>
          <span id="active-filters-count" class="bg-cyan-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full hidden">0</span>
        </div>
      </div>
      <form id="filters" method="GET" action="{{ route('shop') }}#products" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Pet Type</label>
          <select name="pet_type" id="filter-pet" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-white text-gray-900 transition text-sm min-h-[40px]">
            <option value="">All Pets</option>
            <option value="Dog" {{ request('pet_type') == 'Dog' ? 'selected' : '' }}>Dog</option>
            <option value="Cat" {{ request('pet_type') == 'Cat' ? 'selected' : '' }}>Cat</option>
          </select>
        </div>
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Category</label>
          <select name="accessories_type" id="filter-access" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-white text-gray-900 transition text-sm min-h-[40px]">
            <option value="">All Categories</option>
            <option value="Food" {{ request('accessories_type') == 'Food' ? 'selected' : '' }}>Food</option>
            <option value="Toy" {{ request('accessories_type') == 'Toy' ? 'selected' : '' }}>Toy</option>
          </select>
        </div>
        <div class="lg:col-span-1">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Price Range</label>
          <div class="flex space-x-2">
            <input name="min_price" id="filter-min" type="number" placeholder="Min" min="0" value="{{ request('min_price') }}"
              class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-gray-900 text-sm min-h-[40px]" />
            <input name="max_price" id="filter-max" type="number" placeholder="Max" min="0" value="{{ request('max_price') }}"
              class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-gray-900 text-sm min-h-[40px]" />
          </div>
        </div>
        <div class="lg:col-span-2">
          <label class="block text-xs font-semibold text-gray-700 mb-1.5">Search</label>
          <div class="relative">
            <input name="search" id="filter-search" type="text" placeholder="Search products..." autocomplete="off" value="{{ request('search') }}"
              class="w-full px-3 py-2 pl-9 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-gray-900 transition text-sm min-h-[40px]" />
            <svg class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <div id="suggestions" class="absolute left-0 right-0 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-20 max-h-60 overflow-auto">
            </div>
          </div>
        </div>
        <div class="lg:col-span-5 flex justify-end space-x-2">
          <button type="button" id="clear-filters" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
            Clear All
          </button>
          <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition">
            Apply Filters
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Products Section -->
  <section id="products" class="py-8 sm:py-12 px-4 sm:px-6 bg-gray-50 scroll-mt-20">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-6 sm:mb-10">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">Our Products</h2>
        <p class="text-gray-600 text-base sm:text-lg">Browse our collection of premium pet products</p>
      </div>
      <!-- Server-Side Error Display -->
      @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-md">
          <div class="flex items-start">
            <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
              <h3 class="font-bold text-red-800 text-lg mb-2">⚠️ Database Connection Error</h3>
              <p class="text-red-700 mb-3">{{ session('error') }}</p>
              
              @if(session('error_details') && isset(session('error_details')['troubleshooting']))
                <div class="bg-white rounded p-3 mb-3 border border-red-200">
                  <h4 class="font-semibold text-red-800 mb-2">🔧 Troubleshooting Steps:</h4>
                  <ol class="list-decimal list-inside space-y-1 text-sm text-red-700">
                    @foreach(session('error_details')['troubleshooting'] as $step)
                      <li>{{ $step }}</li>
                    @endforeach
                  </ol>
                </div>
              @endif
              
              <div class="bg-white rounded p-3 mb-3 border border-red-200">
                <h4 class="font-semibold text-red-800 mb-2">💡 Quick Fix:</h4>
                <div class="text-sm text-red-700 space-y-2">
                  <p><strong>1. Start SQL Server Service:</strong></p>
                  <code class="block bg-gray-100 p-2 rounded text-xs">Get-Service MSSQL$SQLEXPRESS | Start-Service</code>
                  <p class="mt-2"><strong>2. Or use Services Manager:</strong></p>
                  <p class="text-xs">Press Win+R → type "services.msc" → Find "SQL Server (SQLEXPRESS)" → Right-click → Start</p>
                </div>
              </div>
              
              @if(session('error_details'))
                <details class="mt-2">
                  <summary class="text-sm text-red-600 cursor-pointer hover:text-red-800 font-semibold">📋 Show Technical Details</summary>
                  <pre class="mt-2 p-3 bg-red-100 rounded text-xs overflow-auto max-h-60">{{ json_encode(session('error_details'), JSON_PRETTY_PRINT) }}</pre>
                </details>
              @endif
            </div>
          </div>
        </div>
      @endif

      <!-- Server-Side Image Validation Errors -->
      @if(session('image_validation_errors'))
        <div class="mb-4 p-4 bg-orange-50 border border-orange-200 rounded-lg">
          <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <h3 class="font-bold text-orange-800">⚠️ Image Validation Warnings</h3>
          </div>
          <p class="text-orange-700 mb-2">Found {{ count(session('image_validation_errors')) }} product(s) with image issues:</p>
          <ul class="list-disc list-inside text-sm text-orange-700 space-y-1">
            @foreach(session('image_validation_errors') as $error)
              <li>
                <strong>Product #{{ $error['product_id'] }}:</strong> {{ $error['product_name'] ?? 'N/A' }}
                @if(isset($error['raw_image_url']))
                  <br><span class="text-xs text-orange-600">Raw URL: <code>{{ $error['raw_image_url'] }}</code></span>
                @endif
                @if(isset($error['error']))
                  <br><span class="text-xs text-red-600">Error: {{ $error['error'] }}</span>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Debug Panel (Toggle with Ctrl+D) - Hidden by default -->
      <div id="debug-panel" class="hidden mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
        <div class="flex justify-between items-center mb-2">
          <h3 class="font-bold text-yellow-800">🐛 Image Loading Debug Panel</h3>
          <button onclick="document.getElementById('debug-panel').classList.add('hidden')" class="text-yellow-600 hover:text-yellow-800">✕</button>
        </div>
        <div class="text-xs text-yellow-600 mb-2">Press Ctrl+D to toggle this panel</div>
        <div id="debug-content" class="text-sm text-yellow-700 space-y-1"></div>
      </div>

      <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
        @if(isset($products) && $products->count() > 0)
          @foreach($products as $product)
          @php
            $rawImageUrl = $product->getAttributes()['image_url'] ?? 'N/A';
            $processedImageUrl = $product->image_url ?? 'N/A';
            $assetUrl = $product->getImageAssetUrl();
          @endphp
          <div class="group relative bg-black rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 border border-gray-800" data-product-id="{{ $product->id }}">
            <!-- Image Container with Gradient Overlay -->
            <div class="relative h-72 overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100">
              <img 
                src="{{ $assetUrl }}" 
                alt="{{ $product->product_name }}"
                data-product-id="{{ $product->id }}"
                data-product-name="{{ $product->product_name }}"
                data-raw-image-url="{{ $rawImageUrl }}"
                data-processed-image-url="{{ $processedImageUrl }}"
                data-asset-url="{{ $assetUrl }}"
                class="product-image w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out" 
                loading="lazy"
                onerror="handleImageError(this)"
                onload="handleImageLoad(this)">
              
              <!-- Gradient Overlay on Hover -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              
              <!-- Loading Indicator -->
              <div class="image-loading-indicator absolute inset-0 bg-gray-900 flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-cyan-500 border-t-transparent"></div>
              </div>
              
              <!-- Badge -->
              <div class="absolute top-3 left-3 bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                {{ $product->pet_type }}
              </div>
              
              <!-- Quick Actions -->
              <div class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg hover:bg-cyan-500 hover:text-white transition-all duration-300 transform hover:scale-110 w-9 h-9 flex items-center justify-center">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                  </svg>
                </button>
                <button class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg hover:bg-cyan-500 hover:text-white transition-all duration-300 transform hover:scale-110 w-9 h-9 flex items-center justify-center">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                </button>
              </div>
            </div>
            
            <!-- Product Info -->
            <div class="p-6 bg-black">
              <div class="mb-3">
                <span class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full mb-2">
                  {{ $product->accessories_type }}
                </span>
                <h3 class="text-xl font-bold text-white mb-2 line-clamp-2 group-hover:text-cyan-400 transition-colors duration-300">
                  {{ $product->product_name }}
                </h3>
              </div>
              
              <!-- Rating -->
              <div class="flex items-center gap-2 mb-4">
                <div class="flex text-yellow-400">
                  @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                  @endfor
                </div>
                <span class="text-sm text-gray-300 font-medium">4.5</span>
                <span class="text-xs text-gray-400">(128 reviews)</span>
              </div>
              
              <!-- Price and Add Button -->
              <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                <div>
                  <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">
                    Rs. {{ number_format((float)$product->price, 2) }}
                  </span>
                </div>
                <button class="group/btn bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center gap-1.5 h-9">
                  <svg class="w-4 h-4 group-hover/btn:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  <span>Add</span>
                </button>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <div class="col-span-full text-center py-12">
            @if(session('error'))
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p class="font-bold">Error:</p>
                <p>{{ session('error') }}</p>
              </div>
            @endif
            <p class="text-gray-600 text-lg mb-4">No products found. @if(!isset($products))Please check your database connection.@else Try adjusting your filters.@endif</p>
            @if(!empty(request()->all()))
              <a href="{{ route('shop') }}" class="text-cyan-600 hover:text-cyan-700 font-semibold">Clear all filters</a>
            @endif
          </div>
        @endif
      </div>
    </div>
  </section>
</div>

<script>
  // Image Error Tracking
  const imageErrors = [];
  const imageLoads = [];

  function handleImageError(img) {
    const productId = img.getAttribute('data-product-id');
    const productName = img.getAttribute('data-product-name');
    const rawImageUrl = img.getAttribute('data-raw-image-url');
    const processedImageUrl = img.getAttribute('data-processed-image-url');
    const assetUrl = img.getAttribute('data-asset-url');
    
    // Hide loading indicator
    const loadingIndicator = img.parentElement.querySelector('.image-loading-indicator');
    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }
    
    // Show error indicator
    const errorIndicator = img.parentElement.querySelector('.image-error-indicator');
    if (errorIndicator) {
      errorIndicator.style.display = 'block';
    }
    
    // Try fallback image
    const fallbackUrl = '{{ asset("images/Petmart.png") }}';
    if (img.src !== fallbackUrl) {
      // Only log if debug mode is enabled
      if (window.location.search.includes('debug=1')) {
        console.warn('🖼️ Image Load Error - Attempting Fallback', {
          productId: productId,
          productName: productName,
          attemptedUrl: assetUrl,
          rawImageUrl: rawImageUrl,
          processedImageUrl: processedImageUrl,
          error: 'Image failed to load, trying fallback'
        });
      }
      img.src = fallbackUrl;
      return;
    }
    
    // Fallback also failed - log detailed error (only if debug mode)
    const errorInfo = {
      productId: productId,
      productName: productName,
      rawImageUrl: rawImageUrl,
      processedImageUrl: processedImageUrl,
      assetUrl: assetUrl,
      fallbackUrl: fallbackUrl,
      timestamp: new Date().toISOString(),
      error: 'Both primary and fallback images failed to load'
    };
    
    imageErrors.push(errorInfo);
    
    // Only log errors if debug mode is enabled
    if (window.location.search.includes('debug=1')) {
      console.error('❌ Image Load Failed (Both Primary & Fallback)', errorInfo);
    }
    updateDebugPanel();
  }

  function handleImageLoad(img) {
    const productId = img.getAttribute('data-product-id');
    const productName = img.getAttribute('data-product-name');
    const assetUrl = img.getAttribute('data-asset-url');
    
    // Hide loading indicator
    const loadingIndicator = img.parentElement.querySelector('.image-loading-indicator');
    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }
    
    // Hide error indicator if it was showing
    const errorIndicator = img.parentElement.querySelector('.image-error-indicator');
    if (errorIndicator) {
      errorIndicator.style.display = 'none';
    }
    
    const loadInfo = {
      productId: productId,
      productName: productName,
      assetUrl: assetUrl,
      timestamp: new Date().toISOString()
    };
    
    imageLoads.push(loadInfo);
    // Silent success - only log if debug mode is enabled
    if (window.location.search.includes('debug=1')) {
      console.log('✅ Image Loaded Successfully', loadInfo);
    }
  }

  function updateDebugPanel() {
    const debugPanel = document.getElementById('debug-panel');
    const debugContent = document.getElementById('debug-content');
    
    if (!debugPanel || !debugContent) return;
    
    if (imageErrors.length > 0) {
      debugPanel.classList.remove('hidden');
      let html = `<div class="font-semibold mb-2">❌ Failed Images: ${imageErrors.length}</div>`;
      
      imageErrors.forEach((error, index) => {
        html += `
          <div class="border-l-4 border-red-500 pl-2 mb-2">
            <div><strong>Product #${error.productId}:</strong> ${error.productName}</div>
            <div class="text-xs text-gray-600">Raw URL: <code>${error.rawImageUrl}</code></div>
            <div class="text-xs text-gray-600">Processed URL: <code>${error.processedImageUrl}</code></div>
            <div class="text-xs text-red-600">Asset URL: <code>${error.assetUrl}</code></div>
            <div class="text-xs text-gray-500">Error: ${error.error}</div>
          </div>
        `;
      });
      
      html += `<div class="mt-2 text-xs text-gray-600">✅ Successfully Loaded: ${imageLoads.length} images</div>`;
      debugContent.innerHTML = html;
    } else if (imageLoads.length > 0) {
      debugPanel.classList.remove('hidden');
      debugContent.innerHTML = `
        <div class="text-green-700">✅ All ${imageLoads.length} images loaded successfully!</div>
      `;
    }
  }

  // Toggle debug panel with Ctrl+D
  document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'd') {
      e.preventDefault();
      const debugPanel = document.getElementById('debug-panel');
      if (debugPanel) {
        debugPanel.classList.toggle('hidden');
        if (!debugPanel.classList.contains('hidden')) {
          updateDebugPanel();
        }
      }
    }
  });

    // Check all images after page load (silent unless debug mode)
  window.addEventListener('load', function() {
    setTimeout(function() {
      const allImages = document.querySelectorAll('.product-image');
      let failedCount = 0;
      let successCount = 0;
      
      allImages.forEach(function(img) {
        if (img.complete && img.naturalHeight === 0) {
          failedCount++;
        } else if (img.complete) {
          successCount++;
        }
      });
      
      // Only log if debug mode is enabled or if there are errors
      if (window.location.search.includes('debug=1')) {
        console.log('📊 Image Loading Summary:', {
          total: allImages.length,
          successful: successCount,
          failed: failedCount,
          pending: allImages.length - successCount - failedCount
        });
      }
      
      if (failedCount > 0) {
        console.warn('⚠️ Some images failed to load. Press Ctrl+D to see debug panel.');
        updateDebugPanel();
      }
    }, 2000);
  });
  
  // Handle form submission - scroll to products section
  const filterForm = document.getElementById('filters');
  if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
      // Let form submit normally, then scroll after a short delay
      setTimeout(function() {
        const productsSection = document.getElementById('products');
        if (productsSection) {
          productsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }, 100);
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    // Hero content animation
    const heroContent = document.getElementById('hero-content');
    if (heroContent) {
      setTimeout(function() {
        heroContent.classList.remove('opacity-0', '-translate-x-10');
        heroContent.classList.add('opacity-100', 'translate-x-0');
      }, 100);
    }

    // Update active filters count
    const activeFiltersCount = document.getElementById('active-filters-count');
    const filters = document.getElementById('filters');
    
    if (filters) {
      // Check if any filter is active on page load
      const urlParams = new URLSearchParams(window.location.search);
      const hasFilters = urlParams.get('pet_type') || urlParams.get('accessories_type') || urlParams.get('search') || urlParams.get('min_price') || urlParams.get('max_price');
      
      if (hasFilters) {
        updateActiveFiltersCount();
      }
    }

    // Update active filters count
    function updateActiveFiltersCount() {
      if (!activeFiltersCount) return;
      
      const form = document.getElementById('filters');
      const formData = new FormData(form);
      let count = 0;
      
      for (let [key, value] of formData.entries()) {
        if (value && value.trim() !== '') {
          count++;
        }
      }
      
      if (count > 0) {
        activeFiltersCount.textContent = count;
        activeFiltersCount.classList.remove('hidden');
      } else {
        activeFiltersCount.classList.add('hidden');
      }
    }

    // Clear filters button
    const clearFilters = document.getElementById('clear-filters');
    if (clearFilters) {
      clearFilters.addEventListener('click', function() {
        window.location.href = '{{ route("shop") }}';
      });
    }

    // Update count on filter change
    const filterInputs = document.querySelectorAll('#filters select, #filters input');
    filterInputs.forEach(input => {
      input.addEventListener('change', updateActiveFiltersCount);
      input.addEventListener('input', updateActiveFiltersCount);
    });

    // Search suggestions (optional - can be enhanced with AJAX)
    const searchInput = document.getElementById('filter-search');
    const suggestions = document.getElementById('suggestions');
    
    if (searchInput && suggestions) {
      searchInput.addEventListener('focus', function() {
        // Could implement AJAX search suggestions here
      });
      
      searchInput.addEventListener('blur', function() {
        setTimeout(() => {
          suggestions.classList.add('hidden');
        }, 200);
      });
    }
  });
</script>
@endsection

