<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * GET /api/cart
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json([
                'success' => true,
                'data' => [
                    'items' => [],
                    'subtotal' => 0,
                    'total' => 0
                ]
            ], 200);
        }

        $items = DB::table('cart_items')
            ->join('pets', 'cart_items.pet_id', '=', 'pets.id')
            ->where('cart_items.cart_id', $cart->id)
            ->select('pets.*', 'cart_items.quantity', 'cart_items.id as item_id')
            ->get()
            ->map(function ($item) {
                return [
                    'pet_id' => $item->id,
                    'product_name' => $item->product_name,
                    'price' => (float) $item->price,
                    'quantity' => $item->quantity,
                    'image_url' => asset($item->image_url),
                    'subtotal' => (float) ($item->price * $item->quantity)
                ];
            });

        $subtotal = $items->sum('subtotal');

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $items,
                'subtotal' => (float) $subtotal,
                'total' => (float) $subtotal // Assuming no tax/shipping for simple calculation
            ]
        ], 200);
    }

    /**
     * POST /api/cart/add
     */
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|exists:pets,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;
        
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
            ->where('pet_id', $request->pet_id)
            ->first();

        if ($item) {
            DB::table('cart_items')
                ->where('id', $item->id)
                ->update([
                    'quantity' => $item->quantity + $request->quantity,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('cart_items')->insert([
                'cart_id' => $cartId,
                'pet_id' => $request->pet_id,
                'quantity' => $request->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Added to cart'], 200);
    }

    /**
     * POST /api/cart/remove
     */
    public function remove(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|exists:pets,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;
        $cart = DB::table('cart')->where('user_id', $userId)->first();

        if ($cart) {
            DB::table('cart_items')
                ->where('cart_id', $cart->id)
                ->where('pet_id', $request->pet_id)
                ->delete();
        }

        return response()->json(['success' => true, 'message' => 'Removed from cart'], 200);
    }
}
