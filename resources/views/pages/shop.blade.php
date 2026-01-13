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

  <!-- Livewire Shop Filter Component -->
  @livewire('shop-filter')

  <!-- Favorite Button JavaScript -->
  <script>
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

    // Handle favorite button clicks - works with Livewire updates
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

      // Disable button during request
      btn.disabled = true;
      const svg = btn.querySelector('svg');
      if (svg) svg.classList.add('opacity-50');

      try {
        const res = await fetch(url, options);
        const data = await res.json();

        if (res.ok || res.status === 200 || res.status === 201) {
          btn.dataset.favorited = isFav ? "0" : "1";

          if (svg) {
            if (isFav) {
              svg.classList.remove("text-red-500");
              svg.classList.add("text-gray-400");
              svg.setAttribute("fill", "none");
            } else {
              svg.classList.remove("text-gray-400");
              svg.classList.add("text-red-500");
              svg.setAttribute("fill", "currentColor");
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

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
      initFavoriteButtons();
      
      // Re-initialize after Livewire updates
      document.addEventListener('livewire:load', initFavoriteButtons);
      document.addEventListener('livewire:update', initFavoriteButtons);
      
      // Hero content animation
      const heroContent = document.getElementById('hero-content');
      if (heroContent) {
        setTimeout(function() {
          heroContent.classList.remove('opacity-0', '-translate-x-10');
          heroContent.classList.add('opacity-100', 'translate-x-0');
        }, 100);
      }
    });

    // Also initialize immediately if DOM is already loaded
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initFavoriteButtons);
    } else {
      initFavoriteButtons();
    }
  </script>

    // Hero content animation
    document.addEventListener('DOMContentLoaded', function() {
      const heroContent = document.getElementById('hero-content');
      if (heroContent) {
        setTimeout(function() {
          heroContent.classList.remove('opacity-0', '-translate-x-10');
          heroContent.classList.add('opacity-100', 'translate-x-0');
        }, 100);
      }
    });
  </script>
</div>
@endsection
