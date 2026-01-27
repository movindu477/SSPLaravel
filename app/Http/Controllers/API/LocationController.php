<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'city' => 'required|string'
    ]);

    $user = $request->user();

    $user->latitude = $request->latitude;
    $user->longitude = $request->longitude;
    $user->city = $request->city;
    $user->save();

    return response()->json([
        'message' => 'Location saved successfully'
    ]);
}

}
