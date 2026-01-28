<?php

namespace App\Livewire\Admin;

use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public $product_name;
    public $pet_type = 'Dog';
    public $accessories_type = 'Food';
    public $price;
    public $image_url;
    public $search_image_query;

    public $petTypes = ['Dog', 'Cat', 'Bird', 'Fish', 'Other'];
    public $accessoryTypes = ['Food', 'Toy', 'Accessory', 'Health', 'Other'];

    protected $rules = [
        'product_name' => 'required|string|max:100',
        'pet_type' => 'required|string|max:50',
        'accessories_type' => 'required|string|max:50',
        'price' => 'required|numeric|min:0',
        'image_url' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Pet::create([
            'product_name' => $this->product_name,
            'pet_type' => $this->pet_type,
            'accessories_type' => $this->accessories_type,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'created_at' => now(),
        ]);

        session()->flash('success', 'Product created successfully!');

        // Reset form
        $this->reset(['product_name', 'price', 'image_url']);
        
        return redirect()->route('admin.products');
    }

    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
