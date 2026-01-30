<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * GET /api/pets
     */
    public function index()
    {
        $pets = Pet::all()->map(function ($pet) {
            return [
                'id' => $pet->id,
                'product_name' => $pet->product_name,
                'pet_type' => $pet->pet_type,
                'accessories_type' => $pet->accessories_type,
                'price' => (float) $pet->price,
                'image_url' => asset($pet->image_url),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $pets
        ], 200);
    }

    /**
     * GET /api/pets/{id}
     */
    public function show($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'success' => false,
                'message' => 'Pet not found'
            ], 404);
        }

        $data = [
            'id' => $pet->id,
            'product_name' => $pet->product_name,
            'pet_type' => $pet->pet_type,
            'accessories_type' => $pet->accessories_type,
            'price' => (float) $pet->price,
            'image_url' => asset($pet->image_url),
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
