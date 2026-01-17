@extends('layouts.app')

@section('title', 'PetMart.LK - Your Trusted Pet Care Store')

@section('content')
<div class="min-h-screen">
  <section class="relative h-screen flex items-center pt-16">
    <img src="{{ asset('images/mainback1.avif') }}" alt="PetMart" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative z-10 flex items-center h-full px-4 sm:px-6 md:px-20">
      <div class="max-w-xl text-left transform opacity-0 -translate-x-10 transition-all duration-1000 ease-out" id="hero-content">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-white mb-4 sm:mb-6 drop-shadow-lg leading-tight">
          Welcome to PetMart
        </h1>
        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-100 leading-relaxed drop-shadow-md mb-6 sm:mb-8">
          Your one stop shop for premium pet food, toys, and accessories. We provide quality products to keep your furry friends happy, healthy, and well cared for.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
          <a href="{{ route('shop') }}" class="bg-blue-700 hover:bg-blue-800 active:bg-blue-900 text-white font-semibold px-6 sm:px-8 py-3 rounded-lg shadow-lg transition duration-300 text-center min-h-[44px] flex items-center justify-center">
            Shop Now
          </a>
          <a href="{{ route('about') }}" class="bg-white hover:bg-gray-100 active:bg-gray-200 text-blue-700 font-semibold px-6 sm:px-8 py-3 rounded-lg shadow-lg transition duration-300 text-center min-h-[44px] flex items-center justify-center">
            Learn More
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gradient-to-br from-gray-50 via-white to-blue-50 py-16 sm:py-20 lg:py-24 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-8 lg:gap-12">
        <div id="about-image" class="relative h-[400px] sm:h-[500px] md:h-[600px] w-full md:w-1/2 transform opacity-0 -translate-x-10 scale-95 transition-all duration-1000 ease-out order-1 md:order-1">
          <div class="absolute inset-0 bg-cover bg-center bg-no-repeat rounded-2xl lg:rounded-3xl shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/20 to-transparent"></div>
            <img src="{{ asset('images/main2.jpg') }}" alt="About PetMart" class="w-full h-full object-cover object-right">
          </div>
        </div>

        <div id="about-text" class="text-center md:text-left transform opacity-0 translate-x-10 scale-95 transition-all duration-1000 ease-out order-2 md:order-2 w-full md:w-1/2 max-w-2xl mx-auto md:mx-0 px-4 sm:px-6 lg:px-8">
          <div class="space-y-6">
            <div class="inline-block mb-2">
              <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Our Story</span>
            </div>
            
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
              <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">About</span> PetMart
            </h2>
            
            <div class="space-y-4 text-gray-700 leading-relaxed">
              <p class="text-base sm:text-lg lg:text-xl font-medium">
                At PetMart, we understand that <span class="text-blue-700 font-semibold">pets are family</span>. That's why we're committed to providing the highest quality pet products at affordable prices.
              </p>
              <p class="text-sm sm:text-base lg:text-lg text-gray-600">
                From premium pet food to engaging toys and essential accessories, we offer everything your pet needs to thrive. Our carefully curated selection ensures that every product meets our high standards for quality and safety.
              </p>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-4">
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Quality Assured</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Trusted Brands</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Affordable Prices</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Fast Delivery</span>
              </div>
            </div>
            
            <div class="pt-4">
              <a href="{{ route('about') }}" class="group inline-flex items-center space-x-2 bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1 min-h-[44px]">
                <span>Learn More About Us</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <br>

  <section class="bg-gradient-to-br from-blue-50 via-white to-gray-50 py-16 sm:py-20 lg:py-24 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 translate-y-1/2"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-8 lg:gap-12">
        <div id="shop-text" class="text-center md:text-left transform opacity-0 -translate-x-10 scale-95 transition-all duration-1000 ease-out order-2 md:order-1 w-full md:w-1/2 max-w-2xl mx-auto md:mx-0 px-4 sm:px-6 lg:px-8">
          <div class="space-y-6">
            <div class="inline-block mb-2">
              <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Our Products</span>
            </div>
            
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
              <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">Explore</span> Our Products
            </h2>
            
            <div class="space-y-4 text-gray-700 leading-relaxed">
              <p class="text-base sm:text-lg lg:text-xl font-medium">
                Browse our extensive collection of pet products designed for <span class="text-blue-700 font-semibold">dogs and cats</span>. Whether you're looking for nutritious food, fun toys, or essential accessories, we have something for every pet.
              </p>
              <p class="text-sm sm:text-base lg:text-lg text-gray-600">
                Our products are carefully selected to meet the highest standards of quality and safety. We work with trusted brands to bring you the best options for your furry companions.
              </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Premium Quality Food</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Interactive Toys</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Essential Accessories</span>
              </div>
              <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">Wide Variety</span>
              </div>
            </div>
            
            <div class="pt-4">
              <a href="{{ route('shop') }}" class="group inline-flex items-center space-x-2 bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1 min-h-[44px]">
                <span>Browse Products</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <div id="shop-image" class="relative h-[400px] sm:h-[500px] md:h-[600px] w-full md:w-1/2 transform opacity-0 translate-x-10 scale-95 transition-all duration-1000 ease-out order-1 md:order-2">
          <div class="absolute inset-0 bg-cover bg-center bg-no-repeat rounded-2xl lg:rounded-3xl shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-tl from-blue-900/20 to-transparent"></div>
            <img src="{{ asset('images/main3.jpg') }}" alt="Shop Products" class="w-full h-full object-cover object-right">
          </div>
        </div>
      </div>
    </div>
  </section>

  <br>

  <section class="bg-gradient-to-b from-white via-gray-50 to-white py-20 sm:py-24 relative overflow-hidden">
    <div class="absolute top-1/2 left-0 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute top-1/2 right-0 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10 translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-20 lg:mb-24">
        <div class="inline-block mb-3">
          <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Why Choose Us</span>
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
          Why Choose <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">PetMart?</span>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        <div class="group relative text-center p-8 rounded-2xl bg-white border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 mb-6 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors duration-300">Quality Products</h3>
            <p class="text-gray-600 leading-relaxed">We source only the best products from trusted brands to ensure your pet's health and happiness.</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>

        <div class="group relative text-center p-8 rounded-2xl bg-white border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 mb-6 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors duration-300">Affordable Prices</h3>
            <p class="text-gray-600 leading-relaxed">Competitive pricing without compromising on quality. Great value for your money.</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>

        <div class="group relative text-center p-8 rounded-2xl bg-white border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 mb-6 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-700 transition-colors duration-300">Easy Shopping</h3>
            <p class="text-gray-600 leading-relaxed">Simple and convenient online shopping experience. Browse, add to cart, and checkout with ease.</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gradient-to-r from-blue-50 to-blue-100 py-16">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-gray-900 mb-6">Get in Touch</h2>
      <p class="text-lg text-gray-700 mb-8 leading-relaxed">
        Have questions about our products or need assistance? We're here to help! Reach out to us through any of the following ways.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <svg class="w-8 h-8 text-blue-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          <h3 class="font-semibold text-gray-900 mb-2">Email Us</h3>
          <p class="text-gray-600">info@petmart.lk</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
          <svg class="w-8 h-8 text-blue-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
          </svg>
          <h3 class="font-semibold text-gray-900 mb-2">Call Us</h3>
          <p class="text-gray-600">+94 11 234 5678</p>
        </div>
      </div>
      <a href="{{ route('shop') }}" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition duration-300">
        Start Shopping
      </a>
    </div>
  </section>
</div>

<style>
  .js-enabled {
    /* JavaScript enabled styles */
  }
</style>

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
          entry.target.classList.remove('opacity-0', 'scale-95');
          if (entry.target.id === 'about-image') {
            entry.target.classList.remove('-translate-x-10');
            entry.target.classList.add('translate-x-0', 'scale-100');
          } else if (entry.target.id === 'about-text') {
            entry.target.classList.remove('translate-x-10');
            entry.target.classList.add('translate-x-0', 'scale-100');
          }
          entry.target.classList.add('opacity-100');
        }
      });
    }, observerOptions);

    if (aboutImage) observer.observe(aboutImage);
    if (aboutText) observer.observe(aboutText);

    // Shop section animation
    const shopText = document.getElementById('shop-text');
    const shopImage = document.getElementById('shop-image');
    
    const shopObserver = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.remove('opacity-0', 'scale-95');
          if (entry.target.id === 'shop-text') {
            entry.target.classList.remove('-translate-x-10');
            entry.target.classList.add('translate-x-0', 'scale-100');
          } else if (entry.target.id === 'shop-image') {
            entry.target.classList.remove('translate-x-10');
            entry.target.classList.add('translate-x-0', 'scale-100');
          }
          entry.target.classList.add('opacity-100');
        }
      });
    }, observerOptions);
    
    if (shopText) shopObserver.observe(shopText);
    if (shopImage) shopObserver.observe(shopImage);

    // Fallback: Show content if still hidden after page load
    window.addEventListener('load', function() {
      setTimeout(function() {
        if (heroContent && heroContent.classList.contains('opacity-0')) {
          heroContent.classList.remove('opacity-0', '-translate-x-10');
          heroContent.classList.add('opacity-100', 'translate-x-0');
        }
      }, 500);
    });
  });
</script>
@endsection
