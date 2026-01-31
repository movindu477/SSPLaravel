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

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price (LKR)</label>
            <input type="number" step="0.01" id="price" wire:model.live="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
            
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors">
                <div class="space-y-1 text-center">
                    @if ($image)
                        <div class="mb-4">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="mx-auto h-32 w-32 object-cover rounded-lg shadow-md">
                            <button type="button" wire:click="$set('image', null)" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                Remove Image
                            </button>
                        </div>
                    @else
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                    
                    <div class="flex text-sm text-gray-600 justify-center">
                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only" wire:model="image" accept="image/*">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    
                    <div wire:loading wire:target="image" class="text-blue-600 text-sm mt-2">
                        <svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="block mt-1">Uploading...</span>
                    </div>
                </div>
            </div>
            @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end pt-5 space-x-3">
            <a href="{{ route('admin.products') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Create Product</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>
