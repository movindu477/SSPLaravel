<div class="bg-white rounded-lg shadow-md p-6">
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Product Name -->
        <div>
            <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="product_name" wire:model.live="product_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
            @error('product_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pet Type -->
            <div>
                <label for="pet_type" class="block text-sm font-medium text-gray-700">Pet Type</label>
                <select id="pet_type" wire:model.live="pet_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                    @foreach($petTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('pet_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Accessories Type -->
            <div>
                <label for="accessories_type" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="accessories_type" wire:model.live="accessories_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                     @foreach($accessoryTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('accessories_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price (LKR)</label>
                <input type="number" step="0.01" id="price" wire:model.live="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

             <!-- Image URL -->
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="text" id="image_url" wire:model.live="image_url" placeholder="images/..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                @error('image_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                 <p class="text-xs text-gray-500 mt-1">Local path like 'images/dog.jpg' or HTTP URL</p>
            </div>
        </div>

        @if($image_url)
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Image Preview:</p>
                <div class="w-32 h-32 border rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ Str::startsWith($image_url, ['http', '/']) ? $image_url : asset($image_url) }}" alt="Preview" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/Petmart.png') }}'">
                </div>
            </div>
        @endif

        <div class="flex justify-end pt-5">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <span wire:loading.remove>Create Product</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </form>
</div>
