<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json([], 200);
        }

        $items = DB::table('cart_items')
            ->join('Pets', 'cart_items.pet_id', '=', 'Pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select(
                'Pets.id as pet_id',
                'Pets.product_name',
                'Pets.price',
                'Pets.image_url',
                'cart_items.quantity'
            )
            ->get();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|integer|exists:Pets,id'
        ]);

        $userId = $request->user()->id;
        $petId = $request->pet_id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            $cartId = DB::table('cart')->insertGetId([
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $cartId = $cart->id;
        }

        $item = DB::table('cart_items')
            ->where('cart_id', $cartId)
            ->where('pet_id', $petId)
            ->first();

        if ($item) {
            DB::table('cart_items')
                ->where('id', $item->id)
                ->update([
                    'quantity' => $item->quantity + 1,
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

        return response()->json([
            'success' => true,
            'message' => 'Added to cart'
        ]);
    }

    public function destroy(Request $request, $petId)
    {
        $userId = $request->user()->id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        DB::table('cart_items')
            ->where('cart_id', $cart->id)
            ->where('pet_id', $petId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from cart'
        ]);
    }
    public function update(Request $request, $petId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = $request->user()->id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        DB::table('cart_items')
            ->where('cart_id', $cart->id)
            ->where('pet_id', $petId)
            ->update([
                'quantity' => $request->quantity,
                'updated_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated'
        ]);
    }

}
