<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Unified Checkout API for both Website and Flutter.
     * Handles order creation after payment is processed on the client side.
     */
    public function checkout(Request $request)
    {
        // 1. Validate only the essential payment field (Allows both Site + Flutter)
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 2. Auto-fill shipping with fallback logic (Profile-first approach)
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

        try {
            return DB::transaction(function () use ($user, $cartItems, $cart, $shipping_address, $shipping_city, $shipping_phone) {
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += ($item->price * $item->quantity);
                }
                
                // Keeping tax logic consistent with previous updates (8%)
                $tax = $subtotal * 0.08;
                $finalTotal = $subtotal + $tax;

                // 5. Create order normally with status 'paid'
                $order = Order::create([
                    'user_id' => $user->id,
                    'status' => 'paid',
                    'shipping_address' => $shipping_address,
                    'shipping_city' => $shipping_city,
                    'shipping_phone' => $shipping_phone,
                    'payment_method' => 'stripe',
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $finalTotal,
                    'created_at' => now(),
                ]);

                // 6. Create order items record
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'pet_id' => $item->id,
                        'quantity' => $item->quantity,
                        'price' => $item->price
                    ]);
                }

                // 7. Clear the cart after successful checkout
                DB::table('cart_items')->where('cart_id', $cart->id)->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'order_id' => $order->id,
                    'total' => $finalTotal
                ], 201);
            });

        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Could not complete order. Please try again later.'
            ], 500);
        }
    }
}
