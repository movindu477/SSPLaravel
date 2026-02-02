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
  <!-- Hero Section -->
  <section class="relative pt-10 lg:pt-20 pb-0 overflow-hidden bg-white" style="position: relative; top: 0px; left: 0px; bottom: 50px; right: 0px;">
    <!-- Decorative Yellow Shape -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 lg:opacity-40 animate-blob pointer-events-none hidden md:block"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 pointer-events-none hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
      <div class="flex flex-col md:flex-row items-end justify-between gap-8 lg:gap-16">
        
        <!-- Text Content (Vertically Centered) -->
        <div class="w-full md:w-1/2 text-center md:text-left order-2 md:order-1 self-center pb-8 md:pb-12" style="position: relative; top: -90px; left: 0px; right: 0px; bottom: 0px;">
          <div class="inline-block mb-3">
               <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Premium Selection</span>
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-gray-900 leading-tight mb-4">
            Quality <br>
            <span class="text-blue-600">Pet Products</span>
          </h1>
          <p class="text-lg text-gray-600 mb-6 leading-relaxed max-w-lg mx-auto md:mx-0">
            Discover our wide range of premium pet food, toys, and accessories. Find everything your pet needs in one convenient place.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start mb-8 md:mb-0">
            <a href="#shop-filter" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 text-center min-w-[160px] transform hover:-translate-y-1">
              Start Shopping
            </a>
          </div>
        </div>

        <!-- Image Content (Bottom Aligned) -->
        <div class="w-full md:w-1/2 relative order-1 md:order-2 flex justify-center md:justify-end items-end" style="position: relative; top: 0px; left: 0px; right: 0px; bottom: 0px;">
          <!-- Abstract Background for Image -->
          <svg class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] z-0" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#2563eb" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.3C59.4,45.5,47.9,54.2,35.6,63.2C23.3,72.2,10.2,81.5,-1.9,84.8C-14,88.1,-26.1,85.4,-37.2,78.2C-48.3,71,-58.4,59.3,-67.4,46.7C-76.4,34.1,-84.3,20.6,-86.3,6.2C-88.3,-8.2,-84.4,-23.5,-75.4,-36.2C-66.4,-48.9,-52.3,-59,-38.7,-66.4C-25.1,-73.8,-11.9,-78.5,2.3,-82.5C16.5,-86.5,30.5,-101,44.7,-76.4Z" transform="translate(100 100) scale(1.1)" opacity="0.15" />
          </svg>
          
          <img src="{{ asset('images/shop.png') }}" alt="Shop PetMart" class="relative z-10 w-full max-w-sm md:max-w-md lg:max-w-xl object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500 top-10 md:-top-[150px]" style="position: relative; left: 0px; right: 0px; bottom: 0px; -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%); mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
        </div>

      </div>
    </div>
  </section>

  <!-- Livewire Shop Filter Component -->
  <div id="shop-filter" class="scroll-mt-24">
    @livewire('shop-filter')
  </div>

  <!-- Login Required Modal -->
  <div id="login-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" id="login-modal-backdrop"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="login-modal-panel">
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-xl font-bold leading-6 text-gray-900" id="modal-title">Log In Required</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">You need to be logged in to access this feature. Please log in or create an account to continue buying products.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <a href="{{ route('login') }}" class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto transition-colors">Log In / Register</a>
            <button type="button" onclick="hideLoginModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

    // Modal Functions
    function showLoginModal() {
      const modal = document.getElementById('login-modal');
      const backdrop = document.getElementById('login-modal-backdrop');
      const panel = document.getElementById('login-modal-panel');
      
      modal.classList.remove('hidden');
      setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
        panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
      }, 10);
    }

    function hideLoginModal() {
      const modal = document.getElementById('login-modal');
      const backdrop = document.getElementById('login-modal-backdrop');
      const panel = document.getElementById('login-modal-panel');

      backdrop.classList.add('opacity-0');
      panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
      panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');

      setTimeout(() => {
        modal.classList.add('hidden');
      }, 300);
    }

    // Event Delegation for Favorite Buttons - works even after Livewire re-renders
    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.favorite-btn');
      if (btn) {
        handleFavoriteClick(e, btn);
      }
    });

    async function handleFavoriteClick(e, btn) {
      e.preventDefault();
      e.stopPropagation();
      
      if (!isAuthenticated) {
        showLoginModal();
        return;
      }

      const petId = btn.dataset.petId;
      const url = `/api/favorites/toggle`;

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": csrfToken || "",
          "X-Requested-With": "XMLHttpRequest"
        },
        credentials: 'same-origin',
        body: JSON.stringify({ pet_id: petId })
      };

      // Disable button during request
      btn.disabled = true;
      const svg = btn.querySelector('svg');
      if (svg) svg.classList.add('opacity-50');

      try {
        const response = await fetch(url, options);
        const data = await response.json();
        
        if (response.ok && data.success) {
          const newFavState = data.is_favorited;
          
          btn.setAttribute('data-favorited', newFavState ? "1" : "0");
          
          if (svg) {
            if (newFavState) {
              svg.style.stroke = "#ef4444";
              svg.style.fill = "#ef4444";
            } else {
              svg.style.stroke = "#6b7280";
              svg.style.fill = "none";
            }
          }
        } else {
            console.error('Favorite action failed', response.status);
            alert(data.message || "Something went wrong.");
        }
      } catch (error) {
        console.error("Error toggling favorite:", error);
        alert("Network error.");
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

    // Initialize add to cart forms
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initAddToCartForms);
    } else {
      initAddToCartForms();
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
            
            if (!isAuthenticated) {
            if (!isAuthenticated) {
                showLoginModal();
                return;
            }
            }
            
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
              
              if (response.redirected) {
                  window.location.href = response.url;
                  return;
              }

              const data = await response.json();
              
              if (response.ok && data.success) {
                showAddToCartNotification();
                updateCartCount();
              } else {
                alert(data.message || 'Failed to add to cart');
              }
            } catch (error) {
              console.error('Add to cart error:', error);
              alert('Error adding to cart. Please ensure you are logged in.');
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
      
      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const targetId = this.getAttribute('href').substring(1);
          const targetElement = document.getElementById(targetId);
          if (targetElement) {
            targetElement.scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });
    });

    // If the page is already loaded, set it up now
    if (document.readyState !== 'loading') {
      initAddToCartForms();
    }
  </script>
</div>
@endsection
