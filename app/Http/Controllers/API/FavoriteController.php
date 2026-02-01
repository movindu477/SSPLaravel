<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => auth()->user()->favorites()->with('pet')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pet_id' => 'required|exists:pets,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        auth()->user()->favorites()->firstOrCreate([
            'pet_id' => $request->pet_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Added to favorites'
        ]);
    }

    public function destroy($pet_id)
    {
        auth()->user()->favorites()->where('pet_id', $pet_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from favorites'
        ]);
    }
}
