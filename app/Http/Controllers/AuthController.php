<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
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
            'confirm_password' => 'required|string|same:password',
        ], [
            'password.min' => 'Password must be at least 6 characters.',
            'confirm_password.same' => 'Passwords do not match.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            try {
                $tableExists = DB::selectOne("
                    SELECT COUNT(*) as count 
                    FROM INFORMATION_SCHEMA.TABLES 
                    WHERE TABLE_NAME = 'User' AND TABLE_SCHEMA = 'dbo'
                ");
                
                if (!$tableExists || $tableExists->count == 0) {
                    \Log::error('User table does not exist in database: ' . config('database.connections.sqlsrv.database'));
                    return redirect()->route('register')
                        ->with('error', 'Database table [User] not found in database "' . config('database.connections.sqlsrv.database') . '". Please run the SSPSEM2.sql script in SQL Server Management Studio to create the table.')
                        ->withInput();
                }
            } catch (\Exception $e) {
                \Log::error('Database connection check failed: ' . $e->getMessage());
                return redirect()->route('register')
                    ->with('error', 'Database connection error: ' . $e->getMessage() . '. Please check your .env file and ensure SQL Server is running.')
                    ->withInput();
            }

            $existingUser = DB::selectOne("SELECT TOP 1 id FROM [User] WHERE email = ?", [$request->email]);
            if ($existingUser) {
                return redirect()->route('register')
                    ->with('error', 'This email is already registered.')
                    ->withInput();
            }

            DB::statement("
                INSERT INTO [User] (name, email, phonenumber, address, password, confirm_password, role)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ", [
                $request->name,
                $request->email,
                $request->phonenumber,
                $request->address,
                $request->password,
                $request->confirm_password,
                'user'
            ]);

            return redirect()->route('login')
                ->with('success', 'Registration successful! Please login to continue.');

        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Registration database error: ' . $e->getMessage());
            \Log::error('Error Code: ' . $e->getCode());
            
            if (method_exists($e, 'getSql')) {
                \Log::error('SQL Query: ' . $e->getSql());
            }
            
            $errorMessage = 'Registration failed. ';
            if (str_contains($e->getMessage(), 'UNIQUE constraint') || str_contains($e->getMessage(), 'duplicate key')) {
                $errorMessage = 'This email is already registered.';
            } elseif (str_contains($e->getMessage(), 'NOT NULL constraint')) {
                $errorMessage = 'Please fill in all required fields.';
            } elseif (str_contains($e->getMessage(), 'Invalid object name')) {
                $errorMessage = 'Database table not found. Please contact administrator.';
            } else {
                $errorMessage .= 'Please try again or contact support.';
            }
            
            return redirect()->route('register')
                ->with('error', $errorMessage)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->route('register')
                ->with('error', 'Registration failed: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $userData = DB::selectOne("SELECT TOP 1 * FROM [User] WHERE email = ?", [$request->email]);

            if (!$userData) {
                return redirect()->route('login')
                    ->with('error', 'Invalid email or password.')
                    ->withInput();
            }

            if (trim($request->password) !== trim($userData->password)) {
                return redirect()->route('login')
                    ->with('error', 'Invalid email or password.')
                    ->withInput();
            }

            session([
                'user_id' => $userData->id,
                'user_name' => $userData->name,
                'user_email' => $userData->email,
                'user_phone' => $userData->phonenumber ?? '',
                'user_address' => $userData->address ?? '',
                'user_role' => $userData->role ?? 'user',
            ]);

            if (($userData->role ?? 'user') === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . $userData->name . '!');
            }

            return redirect()->route('home')
                ->with('success', 'Welcome back, ' . $userData->name . '!');

        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Login failed. Please try again.')
                ->withInput();
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.');
    }
}
