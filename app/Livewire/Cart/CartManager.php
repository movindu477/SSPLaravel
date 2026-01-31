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
        // No need to initialize here if we load in render
    }

    public function loadCart()
    {
        $user = Auth::user();
        if (!$user) {
            return [
                'items' => [],
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0
            ];
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
            
            $subtotal = array_sum(array_column($items, 'subtotal'));
            $tax = $subtotal * 0.08;
            $total = $subtotal + $tax;

            return [
                'cartItems' => $items,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ];
        }

        return [
            'cartItems' => [],
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0
        ];
    }

    public function updateQuantity($itemId, $change)
    {
        $userId = Auth::id();
        if (!$userId) return;

        // Verify the item belongs to the user via the cart
        $item = DB::table('cart_items')
            ->join('cart', 'cart_items.cart_id', '=', 'cart.id')
            ->where('cart.user_id', $userId)
            ->where('cart_items.id', $itemId)
            ->select('cart_items.*')
            ->first();

        if ($item) {
            $newQty = (int)$item->quantity + $change;
            if ($newQty > 0 && $newQty <= 99) {
                DB::table('cart_items')->where('id', $itemId)->update(['quantity' => $newQty]);
            } elseif ($newQty <= 0) {
                DB::table('cart_items')->where('id', $itemId)->delete();
            }
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($itemId)
    {
        $userId = Auth::id();
        if (!$userId) return;

        // Verify ownership
        $item = DB::table('cart_items')
            ->join('cart', 'cart_items.cart_id', '=', 'cart.id')
            ->where('cart.user_id', $userId)
            ->where('cart_items.id', $itemId)
            ->select('cart_items.id')
            ->first();

        if ($item) {
            DB::table('cart_items')->where('id', $itemId)->delete();
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        $cartData = $this->loadCart();
        
        $this->cartItems = $cartData['cartItems'];
        $this->subtotal = $cartData['subtotal'];
        $this->tax = $cartData['tax'];
        $this->total = $cartData['total'];

        return view('livewire.cart.cart-manager', $cartData);
    }
}
