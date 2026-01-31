<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartManager extends Component
{
    public $cartItems;
    public $subtotal = 0;
    public $tax = 0;
    public $total = 0;

    public function mount()
    {
        $this->cartItems = collect();
        $this->loadCart();
    }

    public function loadCart()
    {
        $user = Auth::user();
        if (!$user) {
            $this->cartItems = [];
            return;
        }

        $cart = DB::table('cart')->where('user_id', $user->id)->first();
        
        if ($cart) {
            $items = DB::table('cart_items')
                ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
                ->where('cart_items.cart_id', $cart->id)
                ->select(
                    'cart_items.id as item_id',
                    'cart_items.quantity',
                    'pets.id as pet_id',
                    'pets.product_name',
                    'pets.pet_type',
                    'pets.accessories_type',
                    'pets.price',
                    'pets.image_url'
                )
                ->get()
                ->map(function($item) {
                    $item->subtotal = (float)$item->price * $item->quantity;
                    return (array)$item;
                })
                ->toArray();
            
            $this->cartItems = $items;
            $this->subtotal = array_sum(array_column($items, 'subtotal'));
            $this->tax = $this->subtotal * 0.08; // 8% Tax
            $this->total = $this->subtotal + $this->tax;
        } else {
            $this->cartItems = [];
            $this->subtotal = 0;
            $this->tax = 0;
            $this->total = 0;
        }
    }

    public function updateQuantity($itemId, $change)
    {
        $item = DB::table('cart_items')->where('id', $itemId)->first();
        if ($item) {
            $newQuantity = $item->quantity + $change;
            if ($newQuantity > 0) {
                DB::table('cart_items')->where('id', $itemId)->update(['quantity' => $newQuantity]);
            } else {
                DB::table('cart_items')->where('id', $itemId)->delete();
            }
            $this->loadCart();
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($itemId)
    {
        DB::table('cart_items')->where('id', $itemId)->delete();
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.cart.cart-manager');
    }
}
