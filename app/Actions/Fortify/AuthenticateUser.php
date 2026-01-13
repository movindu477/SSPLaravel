<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class AuthenticateUser
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                Fortify::username() => [__('The provided credentials are incorrect.')],
            ]);
        }

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        $token = $user->createToken('web')->plainTextToken;

        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_role' => $user->role ?? 'user',
            'user_token' => $token,
        ]);
    }
}
