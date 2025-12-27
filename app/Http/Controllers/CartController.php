<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|integer'
        ]);

        $userId = auth()->id();
        $petId = $request->pet_id;

        $cart = DB::table('cart')
            ->where('user_id', $userId)
            ->first();

        if (!$cart) {
            $cartId = DB::table('cart')->insertGetId([
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $cartId = $cart->id;
        }

        $exists = DB::table('cart_items')
            ->where('cart_id', $cartId)
            ->where('pet_id', $petId)
            ->first();

        if ($exists) {
            DB::table('cart_items')
                ->where('id', $exists->id)
                ->update([
                    'quantity' => $exists->quantity + 1,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'pet_id' => $petId,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Added to cart');
    }
}
