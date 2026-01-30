<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        // Use 'None' for accessories_type where it was null, because the column is not nullable in migration
        Pet::insert([
            [
                'product_name' => 'Golden Retriever Puppy',
                'pet_type' => 'Dog',
                'accessories_type' => 'None', 
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Persian Cat',
                'pet_type' => 'Cat',
                'accessories_type' => 'None',
                'price' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Dog Food Pack',
                'pet_type' => 'Dog',
                'accessories_type' => 'Food',
                'price' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
