<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * POST /api/checkout
     */
    public function checkout(Request $request)
    {
        // 1. Validate only the essential payment field
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 2. Auto-fill shipping with fallback logic
        $shipping_address = $request->shipping_address ?? $user->address ?? 'Not provided';
        $shipping_city    = $request->shipping_city ?? $user->city ?? 'Not provided';
        $shipping_phone   = $request->shipping_phone ?? $user->phonenumber ?? '0000000000';

        // 3. Get user's cart
        $cart = DB::table('cart')->where('user_id', $user->id)->first();
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }

        // 4. Get items and calculate total
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('pets.*', 'cart_items.quantity')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        return DB::transaction(function () use ($user, $cartItems, $cart, $shipping_address, $shipping_city, $shipping_phone) {
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += ($item->price * $item->quantity);
            }
            
            // Add tax if needed (keeping it consistent with previous web logic)
            $tax = $totalAmount * 0.08;
            $finalTotal = $totalAmount + $tax;

            // 5. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'paid',
                'shipping_address' => $shipping_address,
                'shipping_city' => $shipping_city,
                'shipping_phone' => $shipping_phone,
                'payment_method' => 'stripe',
                'subtotal' => $totalAmount,
                'tax' => $tax,
                'total' => $finalTotal,
                'created_at' => now(),
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'pet_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
            }

            // Clear Cart
            DB::table('cart_items')->where('cart_id', $cart->id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ], 201);
        });
    }

    /**
     * GET /api/orders
     */
    public function index(Request $request)
    {
        $orders = Order::with('items.pet')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }
}
