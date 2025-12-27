<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->user()->id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart empty'], 400);
        }

        $items = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        if ($items->isEmpty()) {
            return response()->json(['message' => 'Cart empty'], 400);
        }

        $subtotal = 0;
        foreach ($items as $item) {
            $price = DB::table('Pets')->where('id', $item->pet_id)->value('price');
            $subtotal += ($price * $item->quantity);
        }

        $tax = 0;
        $total = $subtotal + $tax;

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($items as $item) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'pet_id' => $item->pet_id,
                'quantity' => $item->quantity,
                'price' => DB::table('Pets')->where('id', $item->pet_id)->value('price'),
            ]);
        }

        DB::table('cart_items')->where('cart_id', $cart->id)->delete();

        return response()->json([
            'success' => true,
            'order_id' => $orderId
        ]);
    }
}
