<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to view your profile.');
        }

        $user = User::find(Auth::id());

        if (!$user) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'User not found. Please login again.');
        }

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phonenumber ?? '',
            'user_address' => $user->address ?? '',
            'user_role' => $user->role ?? 'user',
        ]);

        if (($user->role ?? 'user') === 'admin') {
            return redirect()->route('admin.profile');
        }

        $favorites = DB::table('favorites')
            ->join('pets', 'favorites.pet_id', '=', 'pets.id')
            ->where('favorites.user_id', $user->id)
            ->select('pets.*')
            ->get();

        return view('pages.profile', [
            'user' => $user,
            'favorites' => $favorites
        ]);
    }

    public function update(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Validation rules
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phonenumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
        ]);

        try {
            // Update user data
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phonenumber' => $validated['phonenumber'] ?? null,
                'address' => $validated['address'] ?? null,
                'city' => $validated['city'] ?? null,
            ]);

            // Update session
            session([
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_phone' => $user->phonenumber ?? '',
                'user_address' => $user->address ?? '',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
