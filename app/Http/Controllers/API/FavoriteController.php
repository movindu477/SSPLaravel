<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    /**
     * POST /api/favorites/toggle
     */
    public function toggle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|exists:pets,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $userId = $request->user()->id;
        $petId = $request->pet_id;

        $exists = DB::table('favorites')
            ->where('user_id', $userId)
            ->where('pet_id', $petId)
            ->first();

        if ($exists) {
            DB::table('favorites')
                ->where('user_id', $userId)
                ->where('pet_id', $petId)
                ->delete();
            $isFavorited = false;
        } else {
            DB::table('favorites')->insert([
                'user_id' => $userId,
                'pet_id' => $petId,
                'created_at' => now(),
            ]);
            $isFavorited = true;
        }

        return response()->json([
            'success' => true,
            'is_favorited' => $isFavorited,
            'message' => $isFavorited ? 'Added to favorites' : 'Removed from favorites'
        ], 200);
    }

    /**
     * GET /api/favorites
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $favorites = DB::table('favorites')
            ->join('pets', 'favorites.pet_id', '=', 'pets.id')
            ->where('favorites.user_id', $userId)
            ->select('pets.*')
            ->get()
            ->map(function ($pet) {
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
            'data' => $favorites
        ], 200);
    }
}
