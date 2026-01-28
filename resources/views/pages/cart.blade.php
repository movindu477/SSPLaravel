@extends('layouts.app')

@section('title', 'Shopping Cart - PetMart')

@section('content')
<div class="min-h-screen bg-gray-50 py-6 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <livewire:cart.cart-manager />
    </div>
</div>
@endsection

