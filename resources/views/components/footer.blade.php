<footer class="text-white mt-auto" style="background-color: #1e40af;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mb-8">
            <!-- Brand Section -->
            <div class="col-span-2 md:col-span-1 lg:col-span-2">
                <div class="mb-5">
                    <img src="{{ asset('images/Petmart.png') }}" alt="PetMart" class="h-16 w-auto rounded-[10px]">
                </div>
                <p class="text-white text-sm leading-relaxed mb-5 text-justify">
                    Your trusted pet care store. We provide premium pet food, toys, and accessories to keep your furry friends happy and healthy.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-white hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="h-7 w-7">
                    </a>
                    <a href="#" class="text-white hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="h-7 w-7">
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-bold text-base mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-white text-sm hover:opacity-80 transition-opacity block">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-white text-sm hover:opacity-80 transition-opacity block">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="text-white text-sm hover:opacity-80 transition-opacity block">
                            Shop
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart') }}" class="text-white text-sm hover:opacity-80 transition-opacity block">
                            Cart
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-white font-bold text-base mb-4">Customer Service</h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="#" class="text-white hover:opacity-80 transition-opacity block">Shipping Info</a>
                    </li>
                    <li>
                        <a href="#" class="text-white hover:opacity-80 transition-opacity block">Returns</a>
                    </li>
                    <li>
                        <a href="#" class="text-white hover:opacity-80 transition-opacity block">FAQ</a>
                    </li>
                    <li>
                        <a href="#" class="text-white hover:opacity-80 transition-opacity block">Support</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-white font-bold text-base mb-4">Contact Us</h3>
                <ul class="space-y-3 text-sm">
                    <li class="text-white">
                        info@petmart.lk
                    </li>
                    <li class="text-white">
                        +94 11 234 5678
                    </li>
                    <li class="text-white">
                        Colombo, Sri Lanka
                    </li>
                </ul>
            </div>

            <!-- Business Hours -->
            <div>
                <h3 class="text-white font-bold text-base mb-4">Business Hours</h3>
                <ul class="space-y-3 text-sm">
                    <li class="text-white">
                        <span class="font-semibold">Mon - Fri:</span> 9:00 AM - 6:00 PM
                    </li>
                    <li class="text-white">
                        <span class="font-semibold">Saturday:</span> 9:00 AM - 4:00 PM
                    </li>
                    <li class="text-white">
                        <span class="font-semibold">Sunday:</span> Closed
                    </li>
                </ul>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="border-t border-blue-700 pt-6 mb-6">
            <div class="text-center">
                <p class="text-white text-sm mb-3">We Accept</p>
                <div class="flex justify-center items-center gap-4 flex-wrap">
                    <span class="text-white text-xs bg-white/10 px-3 py-1.5 rounded">Credit Cards</span>
                    <span class="text-white text-xs bg-white/10 px-3 py-1.5 rounded">Debit Cards</span>
                    <span class="text-white text-xs bg-white/10 px-3 py-1.5 rounded">Stripe</span>
                    <span class="text-white text-xs bg-white/10 px-3 py-1.5 rounded">Online Payment</span>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-blue-700 pt-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} PetMart.LK. All rights reserved.
                </p>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-white hover:opacity-80 transition-opacity">Privacy Policy</a>
                    <a href="#" class="text-white hover:opacity-80 transition-opacity">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
    
    <button id="scrollToTop" class="fixed bottom-8 left-8 text-white p-4 rounded-full shadow-2xl transition-all duration-300 opacity-0 invisible z-50 hover:scale-110" style="background-color: #1e40af;" aria-label="Scroll to top">
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
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
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
