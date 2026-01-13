<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create new user with custom fields (address, phonenumber, role)
     * Works with SQL Server User table
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:User,email'],
            'phonenumber' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'address' => $input['address'],
                'phonenumber' => $input['phonenumber'],
                'role' => 'user',
                'created_at' => now(),
            ]);

            try {
                $this->createTeam($user);
            } catch (\Exception $e) {
                // Team creation is optional for Jetstream, continue if it fails
            }

            return $user;
        });
    }

    /**
     * Create a personal team for the user
     * Jetstream teams feature - each user gets their own team by default
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
