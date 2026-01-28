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

        <livewire:admin.product-form />
    </div>
</div>
@endsection


