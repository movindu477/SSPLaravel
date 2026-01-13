<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if (($user->role ?? 'user') === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome Admin!');
        }

        return redirect()->route('dashboard')
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }
}
