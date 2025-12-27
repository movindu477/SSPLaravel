<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function index()
    {
        $products = Pet::all()->map(function ($p) {
            $p->image_url = URL::to($p->image_url);
            return $p;
        });

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    public function show($id)
    {
        $product = Pet::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->image_url = URL::to($product->image_url);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
}
