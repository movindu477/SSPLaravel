<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PetsSeeder::class,
        ]);

        if (User::where('email', 'test@example.com')->doesntExist()) {
            User::factory()->withPersonalTeam()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
        
        if (User::where('email', 'admin@petmart.com')->doesntExist()) {
             User::forceCreate([
                'name' => 'Admin User',
                'address' => 'Admin Address',
                'phonenumber' => '0771234567',
                'email' => 'admin@petmart.com',
                'password' => '12345678', // Default password
                'role' => 'admin',
                'created_at' => now(),
            ]);
        }
    }
}
