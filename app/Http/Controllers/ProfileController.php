<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->route('login')
                ->with('error', 'Please login to view your profile.');
        }

        $user = DB::selectOne("SELECT TOP 1 * FROM [User] WHERE id = ?", [session('user_id')]);

        if (!$user) {
            session()->flush();
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

        return view('pages.profile', [
            'user' => $user
        ]);
    }
}
