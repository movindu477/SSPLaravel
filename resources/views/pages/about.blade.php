@extends('layouts.app')

@section('title', 'About Us - PetMart.LK')

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
               <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Who We Are</span>
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-gray-900 leading-tight mb-4">
            Your Trusted <br>
            <span class="text-blue-600">Partner in Pet Care</span>
          </h1>
          <p class="text-lg text-gray-600 mb-6 leading-relaxed max-w-lg mx-auto md:mx-0">
            At PetMart, we are more than just a pet store. We are a community of animal lovers dedicated to providing the best for your furry friends.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start mb-8 md:mb-0">
            <a href="{{ route('shop') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 text-center min-w-[160px] transform hover:-translate-y-1">
              Explore Shop
            </a>

          </div>
        </div>

        <!-- Image Content (Bottom Aligned) -->
        <div class="w-full md:w-1/2 relative order-1 md:order-2 flex justify-center md:justify-end items-end" style="position: relative; top: 0px; left: 0px; right: 0px; bottom: 0px;">
          <!-- Abstract Background for Image -->
          <svg class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] z-0" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path fill="#2563eb" d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,70.8,34.3C59.4,45.5,47.9,54.2,35.6,63.2C23.3,72.2,10.2,81.5,-1.9,84.8C-14,88.1,-26.1,85.4,-37.2,78.2C-48.3,71,-58.4,59.3,-67.4,46.7C-76.4,34.1,-84.3,20.6,-86.3,6.2C-88.3,-8.2,-84.4,-23.5,-75.4,-36.2C-66.4,-48.9,-52.3,-59,-38.7,-66.4C-25.1,-73.8,-11.9,-78.5,2.3,-82.5C16.5,-86.5,30.5,-101,44.7,-76.4Z" transform="translate(100 100) scale(1.1)" opacity="0.15" />
          </svg>
          
          <img src="{{ asset('images/abouthero.png') }}" alt="About PetMart" class="relative z-10 w-full max-w-sm md:max-w-md lg:max-w-xl object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500 top-10 md:-top-[150px]" style="position: relative; left: 0px; right: 0px; bottom: 0px; -webkit-mask-image: linear-gradient(to bottom, black 80%, transparent 100%); mask-image: linear-gradient(to bottom, black 80%, transparent 100%);">
        </div>

      </div>
    </div>
  </section>

  <section id="about-story" class="bg-gradient-to-br from-gray-50 via-white to-blue-50 py-0 pb-16 pt-0 sm:py-20 lg:py-24 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center gap-8 lg:gap-12">
        <div id="about-image" class="relative h-[400px] sm:h-[500px] md:h-[600px] w-full md:w-1/2 transform opacity-0 -translate-x-10 scale-95 transition-all duration-1000 ease-out order-1 md:order-1">
          <div class="absolute inset-0 bg-cover bg-center bg-no-repeat rounded-2xl lg:rounded-3xl shadow-2xl overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/20 to-transparent"></div>
            <img src="{{ asset('images/about1.jpg') }}" alt="Our Story" class="w-full h-full object-cover object-right">
          </div>
        </div>

        <div id="about-text" class="text-center md:text-left transform opacity-0 translate-x-10 scale-95 transition-all duration-1000 ease-out order-2 md:order-2 w-full md:w-1/2 max-w-2xl mx-auto md:mx-0 px-4 sm:px-6 lg:px-8">
          <div class="space-y-6">
            <div class="inline-block mb-2">
              <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Our Story</span>
            </div>
            
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
              <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">PetMart's</span> Journey
            </h2>
            
            <div class="space-y-4 text-gray-700 leading-relaxed">
              <p class="text-base sm:text-lg lg:text-xl font-medium">
                PetMart was founded with a simple yet powerful vision: to be the <span class="text-blue-700 font-semibold">most trusted pet care store</span> in Sri Lanka. We understand that pets are more than just animals—they're family members who deserve the best care and nutrition.
              </p>
              <p class="text-sm sm:text-base lg:text-lg text-gray-600">
                Since our inception, we've been committed to sourcing only the highest quality products from reputable brands. Our team of pet enthusiasts carefully selects each item in our inventory, ensuring that everything we offer meets strict quality standards.
              </p>
              <p class="text-sm sm:text-base lg:text-lg text-gray-600">
                What sets us apart is our dedication to customer service and our genuine love for animals. We're not just a store—we're a community of pet lovers who are here to support you in giving your pets the happy, healthy life they deserve.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gradient-to-b from-white via-gray-50 to-white py-20 sm:py-24 relative overflow-hidden">
    <div class="absolute top-1/2 left-0 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute top-1/2 right-0 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-10 translate-x-1/2 -translate-y-1/2"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-20 lg:mb-24">
        <div class="inline-block mb-3">
          <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Core Principles</span>
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
          Our Mission & <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">Values</span>
        </h2>
        <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto mt-4">
          The principles that guide everything we do at PetMart
        </p>
      </div>
      <br>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
        <div class="group relative bg-white rounded-2xl p-8 lg:p-10 border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-700 to-blue-600 mb-6 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300">Our Mission</h3>
            <p class="text-gray-700 leading-relaxed text-base lg:text-lg">
              To provide pet owners across Sri Lanka with access to premium quality pet products at affordable prices, ensuring every pet receives the care and nutrition they need to thrive and live a happy, healthy life.
            </p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>

        <div class="group relative bg-white rounded-2xl p-8 lg:p-10 border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-700 to-blue-600 mb-6 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300">Our Values</h3>
            <ul class="text-gray-700 space-y-3 text-base lg:text-lg">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Quality first in every product we offer</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Customer satisfaction is our priority</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Transparency and honesty in all dealings</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-blue-700 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Passion for pet welfare and happiness</span>
              </li>
            </ul>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>
      </div>
    </div>
  </section>

<br><br>
  <section class="bg-gradient-to-br from-blue-100 via-blue-50 to-white py-20 sm:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-200/30 via-blue-100/20 to-transparent"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <div class="inline-block mb-3">
          <span class="text-sm font-semibold text-blue-700 uppercase tracking-wider">Contact Us</span>
        </div>
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-4">
          Get in <span class="bg-gradient-to-r from-blue-700 to-blue-600 bg-clip-text text-transparent">Touch</span>
        </h2>
        <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
          Have questions or need assistance? We're here to help! Reach out to us through any of the following ways.
        </p>
      </div>
<br><br>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-12">
        <div class="group relative bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-700 to-blue-600 mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-700 transition-colors duration-300">Phone</h3>
            <a href="tel:+94112345678" class="text-blue-700 hover:text-blue-800 font-semibold text-lg transition-colors">
              +94 11 234 5678
            </a>
            <p class="text-sm text-gray-500 mt-2">Call us anytime</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>
        
        <div class="group relative bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-700 to-blue-600 mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-700 transition-colors duration-300">Email</h3>
            <a href="mailto:info@petmart.lk" class="text-blue-700 hover:text-blue-800 font-semibold text-lg transition-colors break-all">
              info@petmart.lk
            </a>
            <p class="text-sm text-gray-500 mt-2">We'll respond within 24 hours</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>
        
        <div class="group relative bg-white rounded-2xl p-8 text-center border border-gray-100 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-2">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="relative">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-700 to-blue-600 mx-auto mb-4 transform group-hover:scale-110 transition-transform duration-300">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-700 transition-colors duration-300">Location</h3>
            <p class="text-gray-700 font-semibold text-lg">Colombo, Sri Lanka</p>
            <p class="text-sm text-gray-500 mt-2">Visit us at our store</p>
          </div>
          <div class="absolute inset-0 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow duration-300 -z-10"></div>
        </div>
      </div>

      <div class="text-center">
        <a href="{{ route('shop') }}" class="group inline-flex items-center space-x-2 bg-gradient-to-r from-blue-700 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:-translate-y-1">
          <span>Visit Our Shop</span>
          <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
          </svg>
        </a>
      </div>
    </div>
  </section>
</div>
<br><br>
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
