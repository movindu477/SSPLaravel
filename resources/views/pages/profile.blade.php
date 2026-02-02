@extends('layouts.app')

@section('title', 'Profile - PetMart')

@section('content')
@if(!session('user_id'))
    <div class="min-h-screen bg-gray-50 py-12 flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Please Login</h2>
            <p class="text-gray-600 mb-6">You need to be logged in to view your profile.</p>
            <a href="{{ route('login') }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300">
                Go to Login
            </a>
        </div>
    </div>
@else
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-600 to-blue-600 h-32"></div>
            
            <div class="px-8 pb-8 -mt-16">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                    <div class="relative">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                        <button class="absolute bottom-0 right-0 bg-cyan-600 text-white rounded-full p-2 hover:bg-cyan-700 transition-colors shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ session('user_name', $user->name ?? 'Guest User') }}</h1>
                        <p class="text-gray-900 mb-6 font-semibold text-lg">{{ session('user_email', $user->email ?? 'No email') }}</p>
                        <div class="flex flex-wrap gap-4">
                            <span class="bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm font-semibold">
                                {{ ucfirst(session('user_role', $user->role ?? 'user')) }}
                            </span>
                            <span class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-semibold">Verified</span>
                        </div>
                    </div>
                    <button id="edit-profile-btn" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Edit Profile
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-lg p-6 border border-cyan-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Total Orders</h3>
                            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-cyan-600">24</p>
                        <p class="text-sm text-gray-600 mt-2">All time purchases</p>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border border-green-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Total Spent</h3>
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-green-600">Rs. 45,000</p>
                        <p class="text-sm text-gray-600 mt-2">Lifetime value</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Reward Points</h3>
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-blue-600">1,250</p>
                        <p class="text-sm text-gray-600 mt-2">Available points</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Full Name</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 font-medium">
                                    {{ session('user_name', $user->name ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Email Address</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 font-medium">
                                    {{ session('user_email', $user->email ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Phone Number</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 font-medium">
                                    {{ session('user_phone', $user->phonenumber ?? 'N/A') }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Role</label>
                                <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ ucfirst(session('user_role', $user->role ?? 'user')) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Address</label>
                            <div class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 font-medium min-h-[80px]">
                                {{ session('user_address', $user->address ?? 'No address provided') }}
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('shop') }}" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-lg font-semibold text-center transform hover:scale-105 transition-all duration-300">
                                Continue Shopping
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold transform hover:scale-105 transition-all duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Favorites Section -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 mt-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">My Favorites</h2>
                        <a href="{{ route('shop') }}" class="text-cyan-600 hover:text-cyan-700 font-semibold text-sm">View Shop</a>
                    </div>

                    @if($favorites->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($favorites as $favorite)
                                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden group">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ Str::startsWith($favorite->image_url, ['http', '/']) ? $favorite->image_url : asset($favorite->image_url) }}" 
                                             alt="{{ $favorite->product_name }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             onerror="this.src='{{ asset('images/Petmart.png') }}'">
                                        <div class="absolute top-3 right-3">
                                            <span class="bg-white/90 backdrop-blur-sm text-cyan-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                                {{ $favorite->pet_type }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $favorite->product_name }}</h3>
                                        <p class="text-sm text-gray-500 mb-3">{{ $favorite->accessories_type }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-lg font-bold text-cyan-600">Rs. {{ number_format($favorite->price, 2) }}</span>
                                            <a href="{{ route('product.show', $favorite->id) }}" class="text-sm font-semibold text-gray-700 hover:text-cyan-600 transition-colors">
                                                Details →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <p class="text-gray-500 font-medium">You haven't favorited anything yet.</p>
                            <a href="{{ route('shop') }}" class="mt-4 inline-block text-cyan-600 font-bold hover:underline">Start Exploring</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all scale-95 opacity-0" id="modal-content">
        <div class="sticky top-0 bg-gradient-to-r from-cyan-600 to-blue-600 text-white p-6 rounded-t-2xl z-10">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold">Edit Profile</h2>
                <button onclick="closeEditModal()" class="text-white hover:bg-white/20 rounded-full p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <form id="edit-profile-form" class="p-6 space-y-6">
            @csrf
            
            <!-- Success/Error Messages -->
            <div id="form-message" class="hidden rounded-lg p-4"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Full Name *</label>
                    <input type="text" id="edit-name" name="name" value="{{ session('user_name', $user->name ?? '') }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
                    <p class="text-sm text-red-600 hidden" id="name-error"></p>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Email Address *</label>
                    <input type="email" id="edit-email" name="email" value="{{ session('user_email', $user->email ?? '') }}" required
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
                    <p class="text-sm text-red-600 hidden" id="email-error"></p>
                </div>

                <!-- Phone -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Phone Number</label>
                    <input type="tel" id="edit-phone" name="phonenumber" value="{{ session('user_phone', $user->phonenumber ?? '') }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
                    <p class="text-sm text-red-600 hidden" id="phone-error"></p>
                </div>

                <!-- City -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">City</label>
                    <input type="text" id="edit-city" name="city" value="{{ $user->city ?? '' }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all">
                    <p class="text-sm text-red-600 hidden" id="city-error"></p>
                </div>
            </div>

            <!-- Address -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">Address</label>
                <textarea id="edit-address" name="address" rows="3"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100 outline-none transition-all resize-none">{{ session('user_address', $user->address ?? '') }}</textarea>
                <p class="text-sm text-red-600 hidden" id="address-error"></p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4 border-t">
                <button type="button" onclick="closeEditModal()" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-colors">
                    Cancel
                </button>
                <button type="submit" id="save-btn" class="flex-1 px-6 py-3 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Functions
function openEditModal() {
    const modal = document.getElementById('edit-profile-modal');
    const content = document.getElementById('modal-content');
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('edit-profile-modal');
    const content = document.getElementById('modal-content');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Clear messages
        document.getElementById('form-message').classList.add('hidden');
    }, 300);
}

// Open modal on button click
document.getElementById('edit-profile-btn')?.addEventListener('click', openEditModal);

// Form Submission
document.getElementById('edit-profile-form')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const saveBtn = document.getElementById('save-btn');
    const originalText = saveBtn.innerHTML;
    
    // Clear previous errors
    document.querySelectorAll('[id$="-error"]').forEach(el => {
        el.classList.add('hidden');
        el.textContent = '';
    });
    document.getElementById('form-message').classList.add('hidden');
    
    // Show loading state
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    
    const formData = new FormData(this);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    try {
        const response = await fetch("{{ route('profile.update') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            // Show success message
            const msgEl = document.getElementById('form-message');
            msgEl.className = 'bg-green-100 border border-green-200 text-green-800 rounded-lg p-4';
            msgEl.textContent = data.message || 'Profile updated successfully!';
            msgEl.classList.remove('hidden');
            
            // Update displayed values on the page
            if (data.user) {
                // Update all displayed values
                document.querySelectorAll('div').forEach(div => {
                    if (div.textContent.trim() === '{{ session("user_name", $user->name ?? "N/A") }}') {
                        div.textContent = data.user.name;
                    }
                    if (div.textContent.trim() === '{{ session("user_email", $user->email ?? "N/A") }}') {
                        div.textContent = data.user.email;
                    }
                    if (div.textContent.trim() === '{{ session("user_phone", $user->phonenumber ?? "N/A") }}') {
                        div.textContent = data.user.phonenumber || 'N/A';
                    }
                    if (div.textContent.trim() === '{{ session("user_address", $user->address ?? "No address provided") }}') {
                        div.textContent = data.user.address || 'No address provided';
                    }
                });
                
                // Update header name
                document.querySelector('h1').textContent = data.user.name;
            }
            
            // Close modal after 2 seconds
            setTimeout(() => {
                closeEditModal();
                // Refresh page to show updated data
                window.location.reload();
            }, 2000);
            
        } else {
            // Show validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorEl = document.getElementById(field + '-error');
                    if (errorEl) {
                        errorEl.textContent = data.errors[field][0];
                        errorEl.classList.remove('hidden');
                    }
                });
            } else {
                const msgEl = document.getElementById('form-message');
                msgEl.className = 'bg-red-100 border border-red-200 text-red-800 rounded-lg p-4';
                msgEl.textContent = data.message || 'Failed to update profile. Please try again.';
                msgEl.classList.remove('hidden');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        const msgEl = document.getElementById('form-message');
        msgEl.className = 'bg-red-100 border border-red-200 text-red-800 rounded-lg p-4';
        msgEl.textContent = 'Network error. Please check your connection and try again.';
        msgEl.classList.remove('hidden');
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = originalText;
    }
});

// Close modal on backdrop click
document.getElementById('edit-profile-modal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endif
@endsection

