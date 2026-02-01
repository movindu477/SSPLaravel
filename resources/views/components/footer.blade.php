<footer class="bg-[#1e40af] text-white mt-auto relative overflow-hidden">
    <!-- Subtle gradient overlay for depth -->
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 py-12 lg:py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-10 lg:gap-8 mb-12 text-center md:text-left">
            
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-3 lg:col-span-2 flex flex-col items-center md:items-start">
                <div class="mb-6 transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-20 w-auto rounded-xl shadow-lg bg-white/10 p-2 backdrop-blur-sm">
                </div>
                <p class="text-blue-100 text-sm leading-relaxed mb-6 max-w-sm mx-auto md:mx-0 font-medium">
                    Your trusted pet care store. We provide premium pet food, toys, and accessories to keep your furry friends happy and healthy.
                </p>
                <div class="flex space-x-5 justify-center md:justify-start">
                    <a href="#" class="bg-white/10 p-2.5 rounded-full hover:bg-white/20 hover:scale-110 transition-all duration-300 shadow-sm border border-white/10">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="h-5 w-5">
                    </a>
                    <a href="#" class="bg-white/10 p-2.5 rounded-full hover:bg-white/20 hover:scale-110 transition-all duration-300 shadow-sm border border-white/10">
                        <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="h-5 w-5">
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-white font-bold text-lg mb-5 relative inline-block">
                    Quick Links
                    <span class="absolute bottom-0 left-1/2 md:left-0 transform -translate-x-1/2 md:translate-x-0 w-12 h-1 bg-blue-400 rounded-full mt-1 block"></span>
                </h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">About Us</a></li>
                    <li><a href="{{ route('shop') }}" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Shop</a></li>
                    <li><a href="{{ route('cart') }}" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Cart</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-white font-bold text-lg mb-5 relative inline-block">
                    Support
                    <span class="absolute bottom-0 left-1/2 md:left-0 transform -translate-x-1/2 md:translate-x-0 w-8 h-1 bg-blue-400 rounded-full mt-1 block"></span>
                </h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Shipping Info</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Returns</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">FAQ</a></li>
                    <li><a href="#" class="text-blue-100 hover:text-white hover:translate-x-1 transition-all duration-200 block text-sm font-medium">Contact Support</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="flex flex-col items-center md:items-start">
                <h3 class="text-white font-bold text-lg mb-5 relative inline-block">
                    Contact Us
                    <span class="absolute bottom-0 left-1/2 md:left-0 transform -translate-x-1/2 md:translate-x-0 w-10 h-1 bg-blue-400 rounded-full mt-1 block"></span>
                </h3>
                <ul class="space-y-4 text-sm font-medium text-blue-100">
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        info@petmart.lk
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        +94 11 234 5678
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Colombo, Sri Lanka
                    </li>
                </ul>
            </div>

        </div>

        <!-- Payment Methods & Branding Strip -->
        <div class="border-t border-blue-700/50 pt-8 pb-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                <div>
                     <p class="text-blue-200 text-sm font-semibold mb-2">Secure Payment Options</p>
                     <div class="flex justify-center md:justify-start gap-2">
                        <div class="bg-white/10 px-3 py-1 rounded text-xs font-semibold tracking-wide shadow-sm">VISA</div>
                        <div class="bg-white/10 px-3 py-1 rounded text-xs font-semibold tracking-wide shadow-sm">MASTER</div>
                        <div class="bg-white/10 px-3 py-1 rounded text-xs font-semibold tracking-wide shadow-sm">STRIPE</div>
                     </div>
                </div>
                 <!-- Business Hours Compact -->
                <div class="md:text-right">
                    <p class="text-blue-200 text-sm font-semibold mb-2">Opening Hours</p>
                    <p class="text-xs text-blue-100">Mon - Fri: 9:00 AM - 6:00 PM</p>
                    <p class="text-xs text-blue-100">Sat: 9:00 AM - 4:00 PM</p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-blue-700/50 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-blue-200 text-sm text-center md:text-left">
                &copy; {{ date('Y') }} PetMart.LK. All rights reserved.
            </p>
            <div class="flex space-x-6 text-sm font-medium">
                <a href="#" class="text-blue-100 hover:text-white hover:underline decoration-blue-400 underline-offset-4 transition-colors">Privacy Policy</a>
                <a href="#" class="text-blue-100 hover:text-white hover:underline decoration-blue-400 underline-offset-4 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 left-8 bg-blue-600 hover:bg-blue-500 text-white p-3 rounded-full shadow-2xl transition-all duration-300 opacity-0 invisible z-50 hover:scale-110 hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2" aria-label="Scroll to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-10');
                scrollToTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-10');
                scrollToTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
</script>
