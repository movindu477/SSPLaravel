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
        <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-100 leading-relaxed drop-shadow-md">
          We are passionate about providing the best care for your pets. Our mission is to make quality pet products accessible to every pet owner in Sri Lanka.
        </p>
      </div>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="bg-gray-100 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10 items-center">
      <div id="about-image" class="flex justify-center transform opacity-0 -translate-x-10 transition-all duration-1000 ease-out">
        <img src="{{ asset('images/mainback3.avif') }}" alt="About PetMart" class="w-full md:w-[500px] lg:w-[650px] rounded-lg shadow-lg" />
      </div>
      <div id="about-text" class="text-center md:text-left md:pl-16 transform opacity-0 translate-x-10 transition-all duration-1000 ease-out">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
        <p class="text-gray-700 mb-4 leading-relaxed text-lg">
          PetMart was founded with a simple yet powerful vision: to be the most trusted pet care store in Sri Lanka. We understand that pets are more than just animals they're family members who deserve the best care and nutrition.
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed">
          Since our inception, we've been committed to sourcing only the highest quality products from reputable brands. Our team of pet enthusiasts carefully selects each item in our inventory, ensuring that everything we offer meets strict quality standards. We believe that every pet deserves access to premium nutrition and engaging toys that promote their well-being.
        </p>
        <p class="text-gray-600 mb-6 leading-relaxed">
          What sets us apart is our dedication to customer service and our genuine love for animals. We're not just a store—we're a community of pet lovers who are here to support you in giving your pets the happy, healthy life they deserve.
        </p>
      </div>
    </div>
  </section>

  <!-- Mission & Values Section -->
  <section class="bg-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 text-center mb-8 sm:mb-12">Our Mission & Values</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-50 p-8 rounded-lg shadow-md">
          <div class="bg-blue-700 w-12 h-12 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-900 mb-3">Our Mission</h3>
          <p class="text-gray-700 leading-relaxed">
            To provide pet owners across Sri Lanka with access to premium quality pet products at affordable prices, ensuring every pet receives the care and nutrition they need to thrive.
          </p>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-blue-50 p-8 rounded-lg shadow-md">
          <div class="bg-blue-700 w-12 h-12 rounded-full flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold text-gray-900 mb-3">Our Values</h3>
          <ul class="text-gray-700 space-y-2">
            <li class="flex items-start">
              <span class="text-blue-700 mr-2">•</span>
              <span>Quality first in every product we offer</span>
            </li>
            <li class="flex items-start">
              <span class="text-blue-700 mr-2">•</span>
              <span>Customer satisfaction is our priority</span>
            </li>
            <li class="flex items-start">
              <span class="text-blue-700 mr-2">•</span>
              <span>Transparency and honesty in all dealings</span>
            </li>
            <li class="flex items-start">
              <span class="text-blue-700 mr-2">•</span>
              <span>Passion for pet welfare and happiness</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="bg-gradient-to-r from-blue-50 to-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
        <p class="text-lg text-gray-700 max-w-2xl mx-auto">
          Have questions or need assistance? We're here to help! Reach out to us through any of the following ways.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-start">
        <!-- Modern Map Container -->
        <div class="bg-gradient-to-br from-white to-gray-50 p-1 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1">
          <div class="bg-white rounded-xl overflow-hidden">
            <div class="relative h-[400px] md:h-[500px] rounded-xl overflow-hidden">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63322.23199475784!2d79.8150058!3d6.9270786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259244c66d7b9%3A0x6f4f3f0f0f4a8b1c!2sColombo!5e0!3m2!1sen!2slk!4v1631790600000!5m2!1sen!2slk"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                class="rounded-xl">
              </iframe>
              <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg">
                <p class="text-sm font-semibold text-gray-800">📍 Our Location</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contact Information Cards -->
        <div class="space-y-5">
          <div class="bg-gradient-to-br from-white to-cyan-50/30 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-cyan-100/50 group">
            <div class="flex items-start">
              <div class="bg-gradient-to-br from-blue-500 to-cyan-600 w-14 h-14 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Phone</h3>
                <a href="tel:+94112345678" class="text-blue-700 hover:text-blue-800 font-semibold text-lg transition-colors duration-200">
                  +94 11 234 5678
                </a>
                <p class="text-sm text-gray-500 mt-1">Call us anytime</p>
              </div>
            </div>
          </div>
          
          <div class="bg-gradient-to-br from-white to-blue-50/30 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-100/50 group">
            <div class="flex items-start">
              <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-14 h-14 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                <a href="mailto:info@petmart.lk" class="text-blue-600 hover:text-blue-700 font-semibold text-lg transition-colors duration-200 break-all">
                  info@petmart.lk
                </a>
                <p class="text-sm text-gray-500 mt-1">We'll respond within 24 hours</p>
              </div>
            </div>
          </div>
          
          <div class="bg-gradient-to-br from-white to-cyan-50/30 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-cyan-100/50 group">
            <div class="flex items-start">
              <div class="bg-gradient-to-br from-blue-500 to-cyan-600 w-14 h-14 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Location</h3>
                <p class="text-gray-700 font-semibold text-lg">Colombo, Sri Lanka</p>
                <p class="text-sm text-gray-500 mt-1">Visit us at our store</p>
              </div>
            </div>
          </div>
          
          <div class="pt-2">
            <a href="{{ route('shop') }}" class="group inline-flex items-center justify-center w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-800 hover:to-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
              <span>Visit Our Shop</span>
              <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
              </svg>
            </a>
          </div>
        </div>
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
