<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phonenumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check email exists
        $exists = DB::table('User')->where('email', $request->email)->exists();

        if ($exists) {
            return back()
                ->with('error', 'Email already registered')
                ->withInput();
        }

        $hashedPassword = Hash::make($request->password);

        DB::table('User')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'password' => $hashedPassword,
            'confirm_password' => $hashedPassword, // legacy column
            'role' => 'user',
            'created_at' => now(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful. Please login.');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Fetch user manually (SQL Server safe)
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'Invalid email or password')
                ->withInput();
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Create Sanctum token (used by mobile app)
        $token = $user->createToken('web')->plainTextToken;

        // Store session data
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role ?? 'user',
            'user_token' => $token,
        ]);

        // Redirect based on role
        if (($user->role ?? 'user') === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin!');
        }

        return redirect()->route('home')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logged out successfully');
    }
}
