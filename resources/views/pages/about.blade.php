@extends('layouts.app')

@section('title', 'About Us - PetMart.LK')

@section('content')
<div class="min-h-screen">
  <!-- Hero Section -->
  <section class="relative h-screen flex items-center pt-16">
    <img src="{{ asset('images/mainback2.avif') }}" alt="PetMart" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative z-10 flex items-center h-full px-4 sm:px-6 md:px-20">
      <div class="max-w-xl text-left transform opacity-0 -translate-x-10 transition-all duration-1000 ease-out" id="hero-content">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-white mb-4 sm:mb-6 drop-shadow-lg leading-tight">
          About PetMart
        </h1>
        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-100 leading-relaxed drop-shadow-md mb-6 sm:mb-8">
          We are passionate about providing the best care for your pets. Our mission is to make quality pet products accessible to every pet owner in Sri Lanka.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
          <a href="{{ route('shop') }}" class="bg-blue-700 hover:bg-blue-800 active:bg-blue-900 text-white font-semibold px-6 sm:px-8 py-3 rounded-lg shadow-lg transition duration-300 text-center min-h-[44px] flex items-center justify-center">
            Shop Now
          </a>
          <a href="{{ route('home') }}" class="bg-white hover:bg-gray-100 active:bg-gray-200 text-blue-700 font-semibold px-6 sm:px-8 py-3 rounded-lg shadow-lg transition duration-300 text-center min-h-[44px] flex items-center justify-center">
            Back to Home
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="bg-gray-100 py-12 sm:py-16 relative overflow-hidden">
    <div class="relative flex flex-col md:flex-row items-center">
      <div id="about-image" class="relative h-[400px] sm:h-[500px] md:h-[600px] w-full md:w-1/2 transform opacity-0 -translate-x-10 transition-all duration-1000 ease-out order-1 md:order-1">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat rounded-r-[20px] shadow-2xl" style="background-image: url('{{ asset('images/about1.avif') }}');"></div>
      </div>
      <div id="about-text" class="text-center md:text-left md:pl-8 lg:pl-16 transform opacity-0 translate-x-10 transition-all duration-1000 ease-out order-2 md:order-2 w-full md:w-1/2 max-w-2xl mx-auto md:mx-0 px-4 sm:px-6 lg:px-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">Our Story</h2>
        <p class="text-gray-700 mb-4 leading-relaxed text-base sm:text-lg">
          PetMart was founded with a simple yet powerful vision: to be the most trusted pet care store in Sri Lanka. We understand that pets are more than just animals—they're family members who deserve the best care and nutrition.
        </p>
        <p class="text-gray-600 mb-4 leading-relaxed text-sm sm:text-base">
          Since our inception, we've been committed to sourcing only the highest quality products from reputable brands. Our team of pet enthusiasts carefully selects each item in our inventory, ensuring that everything we offer meets strict quality standards.
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed text-sm sm:text-base">
          What sets us apart is our dedication to customer service and our genuine love for animals. We're not just a store—we're a community of pet lovers who are here to support you in giving your pets the happy, healthy life they deserve.
        </p>
      </div>
    </div>
  </section>

  <!-- Mission & Values Section -->
  <section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Our Mission & Values</h2>
        <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
          The principles that guide everything we do at PetMart
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
          <div class="bg-blue-700 w-16 h-16 rounded-full flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
          <p class="text-gray-700 leading-relaxed text-base">
            To provide pet owners across Sri Lanka with access to premium quality pet products at affordable prices, ensuring every pet receives the care and nutrition they need to thrive and live a happy, healthy life.
          </p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
          <div class="bg-blue-700 w-16 h-16 rounded-full flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Values</h3>
          <ul class="text-gray-700 space-y-3 text-base">
            <li class="flex items-start">
              <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Quality first in every product we offer</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Customer satisfaction is our priority</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Transparency and honesty in all dealings</span>
            </li>
            <li class="flex items-start">
              <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              <span>Passion for pet welfare and happiness</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="bg-gray-50 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Why Choose PetMart?</h2>
        <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
          Discover what makes us the preferred choice for pet owners across Sri Lanka
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow duration-300">
          <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Quality Products</h3>
          <p class="text-gray-600 leading-relaxed">We source only the best products from trusted brands to ensure your pet's health and happiness.</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow duration-300">
          <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Affordable Prices</h3>
          <p class="text-gray-600 leading-relaxed">Competitive pricing without compromising on quality. Great value for your money.</p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition-shadow duration-300">
          <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Expert Support</h3>
          <p class="text-gray-600 leading-relaxed">Our knowledgeable team is always ready to help you find the perfect products for your pet.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
        <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
          Have questions or need assistance? We're here to help! Reach out to us through any of the following ways.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 border border-gray-100">
          <div class="bg-blue-700 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Phone</h3>
          <a href="tel:+94112345678" class="text-blue-700 hover:text-blue-800 font-semibold text-lg transition-colors">
            +94 11 234 5678
          </a>
          <p class="text-sm text-gray-500 mt-2">Call us anytime</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 border border-gray-100">
          <div class="bg-blue-700 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
          <a href="mailto:info@petmart.lk" class="text-blue-700 hover:text-blue-800 font-semibold text-lg transition-colors break-all">
            info@petmart.lk
          </a>
          <p class="text-sm text-gray-500 mt-2">We'll respond within 24 hours</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 border border-gray-100">
          <div class="bg-blue-700 w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">Location</h3>
          <p class="text-gray-700 font-semibold text-lg">Colombo, Sri Lanka</p>
          <p class="text-sm text-gray-500 mt-2">Visit us at our store</p>
        </div>
      </div>
      <div class="text-center mt-10">
        <a href="{{ route('shop') }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition duration-300">
          Visit Our Shop
        </a>
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.body.classList.add('js-enabled');
    
    // Hero content animation
    const heroContent = document.getElementById('hero-content');
    if (heroContent) {
      setTimeout(function() {
        heroContent.classList.remove('opacity-0', '-translate-x-10');
        heroContent.classList.add('opacity-100', 'translate-x-0');
      }, 100);
    }

    // About section animation
    const aboutImage = document.getElementById('about-image');
    const aboutText = document.getElementById('about-text');
    
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.remove('opacity-0');
          if (entry.target.id === 'about-image') {
            entry.target.classList.remove('-translate-x-10');
            entry.target.classList.add('translate-x-0');
          } else if (entry.target.id === 'about-text') {
            entry.target.classList.remove('translate-x-10');
            entry.target.classList.add('translate-x-0');
          }
          entry.target.classList.add('opacity-100');
        }
      });
    }, observerOptions);

    if (aboutImage) observer.observe(aboutImage);
    if (aboutText) observer.observe(aboutText);

    // Fallback: Show content if still hidden after page load
    window.addEventListener('load', function() {
      setTimeout(function() {
        if (heroContent && heroContent.classList.contains('opacity-0')) {
          heroContent.classList.remove('opacity-0', '-translate-x-10');
          heroContent.classList.add('opacity-100', 'translate-x-0');
        }
        
        if (aboutImage && aboutImage.classList.contains('opacity-0')) {
          aboutImage.classList.remove('opacity-0', '-translate-x-10');
          aboutImage.classList.add('opacity-100', 'translate-x-0');
        }
        
        if (aboutText && aboutText.classList.contains('opacity-0')) {
          aboutText.classList.remove('opacity-0', 'translate-x-10');
          aboutText.classList.add('opacity-100', 'translate-x-0');
        }
      }, 500);
    });
  });
</script>
@endsection
