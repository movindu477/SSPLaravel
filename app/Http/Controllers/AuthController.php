<?php

namespace App\Http\Controllers;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ================= REGISTER =================
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
        $exists = DB::selectOne(
            "SELECT id FROM [User] WHERE email = ?",
            [$request->email]
        );

        if ($exists) {
            return back()->with('error', 'Email already registered')->withInput();
        }

        $hashedPassword = Hash::make($request->password);

        DB::statement("
            INSERT INTO [User] 
            (name, email, phonenumber, address, password, confirm_password, role)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ", [
            $request->name,
            $request->email,
            $request->phonenumber,
            $request->address,
            $hashedPassword,
            $hashedPassword, // keep table structure intact
            'user'
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful. Please login.');
    }

    // ================= LOGIN =================
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

        $userData = DB::selectOne(
            "SELECT TOP 1 * FROM [User] WHERE email = ?",
            [$request->email]
        );

        if (!$userData) {
            return back()->with('error', 'Invalid email or password')->withInput();
        }

        if (!Hash::check($request->password, $userData->password)) {
            return back()->with('error', 'Invalid email or password')->withInput();
        }

        $user = User::find($userData->id);

        Auth::login($user);
        $request->session()->regenerate();

        $token = $user->createToken('web')->plainTextToken;

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role ?? 'user',
            'user_token' => $token,
        ]);

        if (($user->role ?? 'user') === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin!');
        }

        return redirect()->route('home')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    // ================= LOGOUT =================
    public function logout(Request $request)
    {
        // Revoke Sanctum tokens if user is authenticated
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
        }

        // Logout using Laravel Auth
        Auth::logout();
        
        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logged out successfully');
    }

}
