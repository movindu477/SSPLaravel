<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $errorDetails = null;
        $products = collect([]);
        $favoriteIds = [];

        try {
            $query = Pet::query();

            if ($request->filled('search')) {
                $searchTerm = trim($request->search);
                $query->where('product_name', 'LIKE', '%' . $searchTerm . '%');
            }

            if ($request->filled('pet_type')) {
                $query->where('pet_type', $request->pet_type);
            }

            if ($request->filled('accessories_type')) {
                $query->where('accessories_type', $request->accessories_type);
            }

            if ($request->filled('min_price')) {
                $query->where('price', '>=', (float) $request->min_price);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', (float) $request->max_price);
            }

            $products = $query->orderBy('id')->get();

            if (session()->has('user_id')) {
                $favoriteIds = DB::table('favorites')
                    ->where('user_id', session('user_id'))
                    ->pluck('pet_id')
                    ->toArray();
            }

        } catch (\Exception $e) {

            \Log::error('Product loading error: ' . $e->getMessage());

            $errorDetails = [
                'message' => $e->getMessage()
            ];

            session()->flash('error', 'Unable to load products.');
        }

        return view('pages.shop', compact(
            'products',
            'favoriteIds',
            'errorDetails'
        ));
    }

    public function show($id)
    {
        $product = Pet::findOrFail($id);
        $favoriteIds = [];
        $inCart = false;
        $cartQuantity = 0;
        
        if (auth()->check()) {
            $userId = auth()->id();
            
            $favoriteIds = DB::table('favorites')
                ->where('user_id', $userId)
                ->pluck('pet_id')
                ->toArray();
            
            $cart = DB::table('cart')->where('user_id', $userId)->first();
            if ($cart) {
                $cartItem = DB::table('cart_items')
                    ->where('cart_id', $cart->id)
                    ->where('pet_id', $product->id)
                    ->first();
                
                if ($cartItem) {
                    $inCart = true;
                    $cartQuantity = $cartItem->quantity;
                }
            }
        } elseif (session()->has('user_id')) {
            $favoriteIds = DB::table('favorites')
                ->where('user_id', session('user_id'))
                ->pluck('pet_id')
                ->toArray();
        }
        
        return view('pages.product-detail', compact('product', 'favoriteIds', 'inCart', 'cartQuantity'));
    }
}
