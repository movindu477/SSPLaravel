<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user() ?? $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $favorites = DB::table('favorites')
            ->where('user_id', $user->id)
            ->pluck('pet_id');

        return response()->json([
            'success' => true,
            'data' => $favorites
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user() ?? $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $request->validate([
            'pet_id' => 'required|integer|exists:Pets,id'
        ]);

        DB::table('favorites')->updateOrInsert(
            [
                'user_id' => $user->id,
                'pet_id' => $request->pet_id,
            ],
            [
                'created_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Added to favorites'
        ], 200);
    }

    public function destroy(Request $request, $petId)
    {
        $user = Auth::user() ?? $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        DB::table('favorites')
            ->where('user_id', $user->id)
            ->where('pet_id', $petId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from favorites'
        ], 200);
    }
}
