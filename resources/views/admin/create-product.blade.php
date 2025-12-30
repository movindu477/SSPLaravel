@extends('layouts.app')

@section('title', 'Create Product - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.products') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Products
            </a>
        </div>
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Create New Product</h1>
            <p class="text-gray-600">Add a new product to your store</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <form method="POST" action="{{ route('admin.store-product') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="product_name" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all"
                           placeholder="Enter product name">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pet Type</label>
                        <select name="pet_type" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                            <option value="">Select Pet Type</option>
                            <option value="Dog">Dog</option>
                            <option value="Cat">Cat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select name="accessories_type" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all">
                            <option value="">Select Category</option>
                            <option value="Food">Food</option>
                            <option value="Toy">Toy</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (Rs.)</label>
                    <input type="number" name="price" step="0.01" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all"
                           placeholder="0.00">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image URL</label>
                    <input type="text" name="image_url" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:border-transparent transition-all"
                           placeholder="images/product.jpg">
                    <p class="mt-2 text-sm text-gray-500">Enter the path relative to public folder (e.g., images/dog_food1.jpg)</p>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                        Create Product
                    </button>
                    <a href="{{ route('admin.products') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold text-center transition-all duration-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

