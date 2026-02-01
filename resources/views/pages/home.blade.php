@extends('layouts.app')

@section('title', 'PetMart.LK - Your Trusted Pet Care Store')

@section('content')
<div class="min-h-screen">
  <section class="relative pt-10 lg:pt-20 pb-0 overflow-hidden bg-white" style="position: relative; top: 0px; left: 0px; bottom: 50px; right: 0px;">
    <!-- Decorative Yellow Shape -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 lg:opacity-40 animate-blob pointer-events-none hidden md:block"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 pointer-events-none hidden md:block"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
      <div class="flex flex-col md:flex-row items-end justify-between gap-8 lg:gap-16">
        
        <!-- Text Content (Vertically Centered) -->
        <div class="w-full md:w-1/2 text-center md:text-left order-2 md:order-1 self-center pb-8 md:pb-12" style="position: relative; top: -90px; left: 0px; right: 0px; bottom: 0px;">
          <div class="inline-block mb-3">
               <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">#1 Online Pet Store</span>
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-gray-900 leading-tight mb-4">
            Welcome to <br>
            <span class="text-blue-600">PetMart</span>
          </h1>
          <p class="text-lg text-gray-600 mb-6 leading-relaxed max-w-lg mx-auto md:mx-0">
            Your one stop shop for premium pet food, toys, and accessories. We provide quality products to keep your furry friends happy, healthy, and well cared for.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start mb-8 md:mb-0">
            <a href="{{ route('shop') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 text-center min-w-[160px] transform hover:-translate-y-1">
              Shop Now
            </a>
            <a href="{{ route('about') }}" class="inline-block bg-white hover:bg-gray-50 text-blue-700 border-2 border-blue-100 font-bold px-8 py-3.5 rounded-full transition-all duration-300 text-center min-w-[160px] hover:border-blue-600">
              Learn More
            </a>
          </div>
        </div>

        <!-- Image Content (Bottom Aligned) -->
        <div class="w-full md:w-1/2 relative order-1 md:order-2 flex justify-center md:justify-end items-end" style="position: relative; top: 0px; left: 0px; right: 0px; bottom: 0px;">
          <!-- Abstract Background for Image -->
          <svg class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] z-0" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#2563eb" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.3C59.4,45.5,47.9,54.2,35.6,63.2C23.3,72.2,10.2,81.5,-1.9,84.8C-14,88.1,-26.1,85.4,-37.2,78.2C-48.3,71,-58.4,59.3,-67.4,46.7C-76.4,34.1,-84.3,20.6,-86.3,6.2C-88.3,-8.2,-84.4,-23.5,-75.4,-36.2C-66.4,-48.9,-52.3,-59,-38.7,-66.4C-25.1,-73.8,-11.9,-78.5,2.3,-82.5C16.5,-86.5,30.5,-101,44.7,-76.4Z" transform="translate(100 100) scale(1.1)" opacity="0.15" />
          </svg>
          
          <img src="{{ asset('images/homehero.png') }}" alt="PetMart Hero" class="relative z-10 w-full max-w-sm md:max-w-md lg:max-w-xl object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500 top-10 md:-top-[150px]" style="position: relative; left: 0px; right: 0px; bottom: 0px; -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%); mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
        </div>

      </div>
    </div>
    

  </section>

  <section class="bg-gradient-to-br from-gray-50 via-white to-blue-50 py-0 pb-16 pt-0 sm:py-20 lg:py-24 relative overflow-hidden">
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
        <!-- Box 1 -->
        <div class="group relative h-80 sm:h-96 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
          <!-- Background Image -->
          <img src="/images/home1.jpg" alt="Quality Products" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          
          <!-- Dark Overlay Gradient -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/50 to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
          
          <!-- Content Container - Bottom Left -->
          <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
            <!-- Title Section -->
            <div class="transform transition-transform duration-500 md:translate-y-4 md:group-hover:translate-y-0">
               <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg backdrop-blur-md bg-opacity-90">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-white tracking-wide drop-shadow-md">Quality Products</h3>
              </div>

              <!-- Description - Slides up on Desktop Hover, Visible on Mobile -->
              <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-40 opacity-100 md:max-h-0 md:opacity-0 md:group-hover:max-h-40 md:group-hover:opacity-100">
                <p class="text-gray-200 text-sm leading-relaxed border-l-2 border-blue-500 pl-3 mt-2 font-medium">
                  We source only the best products from trusted brands to ensure your pet's health and happiness.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Box 2 -->
        <div class="group relative h-80 sm:h-96 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
          <!-- Background Image -->
          <img src="/images/home2.jpg" alt="Affordable Prices" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          
          <!-- Dark Overlay Gradient -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/50 to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
          
          <!-- Content Container - Bottom Left -->
          <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
            <!-- Title Section -->
            <div class="transform transition-transform duration-500 md:translate-y-4 md:group-hover:translate-y-0">
               <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg backdrop-blur-md bg-opacity-90">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-white tracking-wide drop-shadow-md">Affordable Prices</h3>
              </div>

              <!-- Description - Slides up on Desktop Hover, Visible on Mobile -->
              <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-40 opacity-100 md:max-h-0 md:opacity-0 md:group-hover:max-h-40 md:group-hover:opacity-100">
                <p class="text-gray-200 text-sm leading-relaxed border-l-2 border-blue-500 pl-3 mt-2 font-medium">
                  Competitive pricing without compromising on quality. Great value for your money.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Box 3 -->
        <div class="group relative h-80 sm:h-96 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer">
          <!-- Background Image -->
          <img src="/images/home3.jpg" alt="Easy Shopping" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
          
          <!-- Dark Overlay Gradient -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/50 to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
          
          <!-- Content Container - Bottom Left -->
          <div class="absolute inset-0 flex flex-col justify-end p-8 z-10">
            <!-- Title Section -->
            <div class="transform transition-transform duration-500 md:translate-y-4 md:group-hover:translate-y-0">
               <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg backdrop-blur-md bg-opacity-90">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-white tracking-wide drop-shadow-md">Easy Shopping</h3>
              </div>

              <!-- Description - Slides up on Desktop Hover, Visible on Mobile -->
              <div class="overflow-hidden transition-all duration-500 ease-in-out max-h-40 opacity-100 md:max-h-0 md:opacity-0 md:group-hover:max-h-40 md:group-hover:opacity-100">
                <p class="text-gray-200 text-sm leading-relaxed border-l-2 border-blue-500 pl-3 mt-2 font-medium">
                  Simple and convenient online shopping experience. Browse, add to cart, and checkout with ease.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gradient-to-br from-gray-50 via-white to-blue-50 py-16 sm:py-20 lg:py-24 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 translate-y-1/2"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-10 lg:gap-16">
        
        <!-- Text Content (Order 2 on Mobile, Order 1 on Desktop -> Left) -->
        <div class="w-full md:w-1/2 order-2 md:order-1 text-center md:text-left">
          <div class="space-y-8">
            <div class="flex justify-center md:justify-start">
              <span class="text-sm font-semibold text-blue-600 uppercase tracking-wider bg-blue-100/50 px-3 py-1 rounded-full border border-blue-200">Contact Us</span>
            </div>
            
            <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
              Get in <span class="bg-gradient-to-r from-blue-700 to-blue-500 bg-clip-text text-transparent">Touch</span>
            </h2>
            
            <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto md:mx-0">
              Have questions about our products or need assistance? Our team is always here to help you with expert advice and support.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- Email Card -->
              <div class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-300 text-center md:text-left">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Email Us</h3>
                <p class="text-gray-500 text-sm">info@petmart.lk</p>
              </div>

              <!-- Call Card -->
              <div class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-lg border border-gray-100 transition-all duration-300 text-center md:text-left">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4 mx-auto md:mx-0 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Call Us</h3>
                <p class="text-gray-500 text-sm">+94 11 234 5678</p>
              </div>
            </div>

            <div class="pt-2 flex justify-center md:justify-start">
              <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1">
                Start Shopping
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Image (Order 1 on Mobile, Order 2 on Desktop -> Right) -->
        <div class="w-full md:w-1/2 order-1 md:order-2">
          <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
             <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
             <!-- Aspect Ratio Container -->
             <div class="aspect-w-4 aspect-h-3 md:aspect-w-1 md:aspect-h-1 lg:aspect-w-4 lg:aspect-h-3">
               <img src="/images/home4.jpg" alt="Contact PetMart" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
             </div>
          </div>
        </div>
        
      </div>
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

    // About section animation (Enter only)
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

    // Shop section animation (Enter only)
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
