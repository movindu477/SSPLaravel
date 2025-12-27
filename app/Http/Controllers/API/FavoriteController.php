<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * GET /api/favorites
     * Return all favorite pet_ids for logged-in user
     */
    public function index(Request $request)
    {
        $favorites = DB::table('favorites')
            ->where('user_id', $request->user()->id)
            ->pluck('pet_id');

        return response()->json([
            'success' => true,
            'data' => $favorites
        ], 200);
    }

    /**
     * POST /api/favorites
     * Add pet to favorites
     */
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|integer|exists:Pets,id'
        ]);

        DB::table('favorites')->updateOrInsert(
            [
                'user_id' => $request->user()->id,
                'pet_id' => $request->pet_id,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Added to favorites'
        ], 200);
    }

    /**
     * DELETE /api/favorites/{petId}
     * Remove pet from favorites
     */
    public function destroy(Request $request, $petId)
    {
        DB::table('favorites')
            ->where('user_id', $request->user()->id)
            ->where('pet_id', $petId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from favorites'
        ], 200);
    }
}
