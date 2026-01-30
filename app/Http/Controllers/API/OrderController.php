<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        // Retrieve the user's active cart
        $cart = DB::table('cart')
            ->where('user_id', $user->id)
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 400);
        }

        // Fetch all items from the cart, joining with Pets table for price verification
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select(
                'cart_items.pet_id',
                'cart_items.quantity',
                'pets.price'
            )
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        // Create a new pending order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        // Transfer cart items to order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pet_id' => $item->pet_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear the user's cart after successful order creation
        DB::table('cart_items')->where('cart_id', $cart->id)->delete();

        return response()->json([
            'message' => 'Order created successfully',
            'order_id' => $order->id,
        ]);
    }

    public function index(Request $request)
    {
        return Order::with('items')
            ->where('user_id', $request->user()->id)
            ->get();
    }
}
