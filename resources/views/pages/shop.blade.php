@extends('layouts.app')


@section('title', 'Shop - PetMart.LK')

@section('content')
<!-- Success Notification for Add to Cart -->
<div id="addToCartNotification" class="hidden fixed top-24 right-8 z-50 transform translate-x-full transition-transform duration-300">
    <div class="bg-white rounded-xl shadow-2xl p-6 flex items-center gap-4 border-l-4 border-green-500 min-w-[320px]">
        <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-gray-900">Added to Cart!</p>
            <p class="text-sm text-gray-600">Product added successfully</p>
        </div>
        <div class="flex-shrink-0">
            <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Order Success Notification -->
<div id="orderSuccessNotification" class="hidden fixed top-24 right-8 z-50 transform translate-x-full transition-transform duration-300">
    <div class="bg-white rounded-xl shadow-2xl p-6 flex items-center gap-4 border-l-4 border-green-500 min-w-[360px]">
        <div class="flex-shrink-0 w-14 h-14 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-bold text-gray-900 text-lg">Order Placed Successfully</p>
            <p class="text-sm text-gray-600">Your payment was processed and order confirmed</p>
        </div>
    </div>
</div>

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

  <!-- Livewire Shop Filter Component -->
  @livewire('shop-filter')

  <script>
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

    // I added this to set up click handlers for the heart/favorite buttons
    function initFavoriteButtons() {
      document.querySelectorAll('.favorite-btn').forEach(btn => {
        if (!btn.hasAttribute('data-listener-attached')) {
          btn.setAttribute('data-listener-attached', 'true');
          btn.addEventListener('click', handleFavoriteClick);
        }
      });
    }

    async function handleFavoriteClick(e) {
      e.preventDefault();
      e.stopPropagation();
      
      if (!isAuthenticated) {
        alert("Please login first");
        window.location.href = "{{ route('login') }}";
        return;
      }

      const btn = e.currentTarget;
      const petId = btn.dataset.petId;
      const isFav = btn.dataset.favorited === "1";

      const url = isFav 
        ? `/api/favorites/${petId}` 
        : `/api/favorites`;

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const options = {
        method: isFav ? "DELETE" : "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": csrfToken || "",
          "X-Requested-With": "XMLHttpRequest"
        },
        credentials: 'same-origin',
        body: isFav ? null : JSON.stringify({ pet_id: petId })
      };

      // I'm disabling the button while the request is happening so users don't click it multiple times
      btn.disabled = true;
      const svg = btn.querySelector('svg');
      if (svg) svg.classList.add('opacity-50');

      try {
        const res = await fetch(url, options);
        const data = await res.json();

        if (res.ok || res.status === 200 || res.status === 201) {
          btn.dataset.favorited = isFav ? "0" : "1";

          if (svg) {
            // Keep icon visible even if Tailwind classes/styles clash:
            // - Favorited: filled red
            // - Not favorited: gray outline
            if (isFav) {
              svg.setAttribute("style", "stroke:#6b7280;fill:none;");
            } else {
              svg.setAttribute("style", "stroke:#ef4444;fill:#ef4444;");
            }
          }
        } else {
          console.error("Error:", data);
          alert("Failed to update favorite: " + (data.message || "Unknown error"));
        }
      } catch (error) {
        console.error("Fetch error:", error);
        alert("Network error. Please try again.");
      } finally {
        btn.disabled = false;
        if (svg) svg.classList.remove('opacity-50');
      }
    }

    // I added this to show a nice message after successful payment
    function showOrderSuccessNotification() {
      const notification = document.getElementById('orderSuccessNotification');
      
      notification.classList.remove('hidden');
      setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
      }, 10);
      
      setTimeout(() => {
        notification.classList.remove('translate-x-0');
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          notification.classList.add('hidden');
        }, 300);
      }, 5000); // Show for 5 seconds
    }

    // This resets the cart badge to 0 after checkout
    function resetCartCount() {
      const cartCountElements = document.querySelectorAll('[data-cart-count]');
      cartCountElements.forEach(element => {
        element.textContent = '0';
      });
    }

    // Setting everything up when the page loads
    document.addEventListener('DOMContentLoaded', function() {
      initFavoriteButtons();
      
      // I need to re-attach the buttons after Livewire updates the page
      document.addEventListener('livewire:load', initFavoriteButtons);
      document.addEventListener('livewire:update', initFavoriteButtons);
      
      // This animates the hero text sliding in from the left
      const heroContent = document.getElementById('hero-content');
      if (heroContent) {
        setTimeout(function() {
          heroContent.classList.remove('opacity-0', '-translate-x-10');
          heroContent.classList.add('opacity-100', 'translate-x-0');
        }, 100);
      }

      // Checking if we just came back from a successful payment
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('order_success') === '1') {
        showOrderSuccessNotification();
        resetCartCount();
        
        // I'm removing the URL parameter so it doesn't show the notification again on refresh
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
      }
    });

    // In case the page is already loaded, I'll initialize right away
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initFavoriteButtons);
    } else {
      initFavoriteButtons();
    }

    // This shows the "Added to Cart" notification
    function showAddToCartNotification() {
      const notification = document.getElementById('addToCartNotification');
      
      notification.classList.remove('hidden');
      setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
      }, 10);
      
      setTimeout(() => {
        notification.classList.remove('translate-x-0');
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          notification.classList.add('hidden');
        }, 300);
      }, 3000);
    }

    function updateCartCount() {
      // Updating the cart number in the navbar
      const cartCountEl = document.querySelector('[data-cart-count]');
      if (cartCountEl) {
        const currentCount = parseInt(cartCountEl.textContent) || 0;
        cartCountEl.textContent = currentCount + 1;
      }
    }

    // I'm intercepting the "Add to Cart" forms to use AJAX instead of page reload
    function initAddToCartForms() {
      document.querySelectorAll('form[action*="cart.add"]').forEach(form => {
        if (!form.hasAttribute('data-ajax-attached')) {
          form.setAttribute('data-ajax-attached', 'true');
          form.addEventListener('submit', async function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Showing "Adding..." so users know something is happening
            submitBtn.disabled = true;
            submitBtn.textContent = 'Adding...';
            
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            try {
              const response = await fetch(this.action, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': csrfToken || '',
                  'X-Requested-With': 'XMLHttpRequest',
                  'Accept': 'application/json',
                },
                body: formData,
                credentials: 'same-origin'
              });
              
              const data = await response.json();
              
              if (response.ok && data.success) {
                showAddToCartNotification();
                updateCartCount();
              } else {
                alert(data.message || 'Failed to add to cart');
              }
            } catch (error) {
              console.error('Add to cart error:', error);
              alert('Error adding to cart. Please try again.');
            } finally {
              submitBtn.disabled = false;
              submitBtn.textContent = originalText;
            }
          });
        }
      });
    }

    // Setting up add to cart forms when everything loads
    document.addEventListener('DOMContentLoaded', function() {
      initAddToCartForms();
      
      // Need to re-setup after Livewire changes the product list
      document.addEventListener('livewire:load', initAddToCartForms);
      document.addEventListener('livewire:update', initAddToCartForms);
    });

    // If the page is already loaded, set it up now
    if (document.readyState !== 'loading') {
      initAddToCartForms();
    }
  </script>
</div>
@endsection
