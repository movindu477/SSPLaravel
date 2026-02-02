<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Component
{
    use WithFileUploads;

    public $product_name;
    public $pet_type = 'Dog';
    public $accessories_type = 'Food';
    public $price;
    public $image;
    public $image_url;

    public $petTypes = ['Dog', 'Cat', 'Bird', 'Fish', 'Other'];
    public $accessoryTypes = ['Food', 'Toy', 'Accessory', 'Health', 'Other'];

    protected $rules = [
        'product_name' => 'required|string|max:100',
        'pet_type' => 'required|string|max:50',
        'accessories_type' => 'required|string|max:50',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048', // 2MB max
    ];

    protected $messages = [
        'image.image' => 'The file must be an image (jpeg, png, jpg, gif, svg).',
        'image.max' => 'The image size must not exceed 2MB.',
    ];

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048',
        ]);
    }

    public function save()
    {
        $this->validate();

        // Handle image upload
        $imagePath = null;
        if ($this->image) {
            // Store in public/images/products
            $extension = $this->image->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $this->image->storeAs('images/products', $filename, 'public');
            $imagePath = 'images/products/' . $filename;
        }

        Pet::create([
            'product_name' => $this->product_name,
            'pet_type' => $this->pet_type,
            'accessories_type' => $this->accessories_type,
            'price' => $this->price,
            'image_url' => $imagePath ?? 'images/Petmart.png',
            'created_at' => now(),
        ]);

        session()->flash('success', 'Product created successfully!');

        // Reset form
        $this->reset(['product_name', 'price', 'image', 'image_url']);
        
        return redirect()->route('admin.products');
    }

    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
