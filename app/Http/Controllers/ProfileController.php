<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Store user data in session
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

        return view('pages.profile', [
            'user' => $user
        ]);
    }
}
