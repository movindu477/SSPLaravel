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
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;

        // Get user's cart
        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }

        // Get items
        $cartItems = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('pets.*', 'cart_items.quantity')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        return DB::transaction(function () use ($request, $userId, $cartItems, $cart) {
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += ($item->price * $item->quantity);
            }

            // Create Order
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'paid', // Assuming payment happened on mobile
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_phone' => $request->shipping_phone,
                'payment_method' => $request->payment_method,
                'total' => $subtotal,
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
