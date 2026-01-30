<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $products = [
            ['id' => 1, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 1500.00, 'image_url' => 'images/dog_food1.jpg', 'product_name' => 'Pedigree Puppy Chicken & Milk'],
            ['id' => 2, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 1800.00, 'image_url' => 'images/dog_food2.jpg', 'product_name' => 'Royal Canin Maxi Adult'],
            ['id' => 3, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 2200.00, 'image_url' => 'images/dog_food3.jpg', 'product_name' => 'Drools Chicken & Egg Puppy Food'],
            ['id' => 4, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 1700.00, 'image_url' => 'images/dog_food4.jpg', 'product_name' => 'Purepet Meat & Rice Adult Dog Food'],
            ['id' => 5, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 2500.00, 'image_url' => 'images/dog_food5.jpg', 'product_name' => 'Farmina N&D Chicken & Pomegranate'],
            ['id' => 6, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 2000.00, 'image_url' => 'images/dog_food6.jpg', 'product_name' => 'SmartHeart Chicken & Liver Flavour'],
            ['id' => 7, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 1900.00, 'image_url' => 'images/dog_food7.jpg', 'product_name' => 'Canine Creek Starter Puppy Food'],
            ['id' => 8, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 2300.00, 'image_url' => 'images/dog_food8.jpg', 'product_name' => 'Meat Up Dry Puppy Food'],
            ['id' => 9, 'pet_type' => 'Dog', 'accessories_type' => 'Food', 'price' => 2100.00, 'image_url' => 'images/dog_food9.jpg', 'product_name' => 'Orijen Puppy Large Breed Dog Food'],
            ['id' => 10, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1200.00, 'image_url' => 'images/dog_toy1.jpg', 'product_name' => 'Chew Bone Rubber Toy'],
            ['id' => 11, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1500.00, 'image_url' => 'images/dog_toy2.webp', 'product_name' => 'Squeaky Plush Dog Toy'],
            ['id' => 12, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1800.00, 'image_url' => 'images/dog_toy3.webp', 'product_name' => 'Rope Tug Toy for Dogs'],
            ['id' => 13, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 2000.00, 'image_url' => 'images/dog_toy4.webp', 'product_name' => 'Interactive Treat Dispenser Ball'],
            ['id' => 14, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1600.00, 'image_url' => 'images/dog_toy5.jpg', 'product_name' => 'Frisbee Flying Disc'],
            ['id' => 15, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1750.00, 'image_url' => 'images/dog_toy6.jpg', 'product_name' => 'Tough Rubber Chew Ring'],
            ['id' => 16, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1400.00, 'image_url' => 'images/dog_toy7.jpg', 'product_name' => 'Plush Duck Squeaker Toy'],
            ['id' => 17, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 1900.00, 'image_url' => 'images/dog_toy8.webp', 'product_name' => 'Dental Chew Toy'],
            ['id' => 18, 'pet_type' => 'Dog', 'accessories_type' => 'Toy', 'price' => 2200.00, 'image_url' => 'images/dog_toy9.jpg', 'product_name' => 'Interactive Puzzle Toy'],
            ['id' => 19, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 850.00, 'image_url' => 'images/catfood1.jpg', 'product_name' => 'Whiskas Chicken Dry Food 1kg'],
            ['id' => 20, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 920.00, 'image_url' => 'images/catfood2.jpg', 'product_name' => 'Me-O Tuna Cat Food 1.2kg'],
            ['id' => 21, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 1100.00, 'image_url' => 'images/catfood3.jpg', 'product_name' => 'Purina Friskies Seafood Sensations 1kg'],
            ['id' => 22, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 990.00, 'image_url' => 'images/catfood4.webp', 'product_name' => 'Royal Canin Kitten Dry Food 400g'],
            ['id' => 23, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 1300.00, 'image_url' => 'images/catfood5.webp', 'product_name' => 'Drools Ocean Fish Adult Cat Food 1.2kg'],
            ['id' => 24, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 870.00, 'image_url' => 'images/catfood6.webp', 'product_name' => 'Sheba Melty Tuna Stick Cat Treats 12pcs'],
            ['id' => 25, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 1150.00, 'image_url' => 'images/catfood7.webp', 'product_name' => 'Farmina Matisse Salmon Cat Food 1kg'],
            ['id' => 26, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 980.00, 'image_url' => 'images/catfood8.png', 'product_name' => 'Whiskas Ocean Fish Adult Cat Food 1.1kg'],
            ['id' => 27, 'pet_type' => 'Cat', 'accessories_type' => 'Food', 'price' => 1250.00, 'image_url' => 'images/catfood9.webp', 'product_name' => 'Royal Canin Persian Adult Cat Food 400g'],
            ['id' => 28, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 650.00, 'image_url' => 'images/cattoy1.webp', 'product_name' => 'Feather Wand Cat Teaser'],
            ['id' => 29, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 720.00, 'image_url' => 'images/cattoy2.jpg', 'product_name' => 'Catnip Plush Mouse Toy'],
            ['id' => 30, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 950.00, 'image_url' => 'images/cattoy3.jpg', 'product_name' => 'Interactive Ball Toy'],
            ['id' => 31, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 800.00, 'image_url' => 'images/cattoy4.jpg', 'product_name' => 'Cat Tunnel Play Tube'],
            ['id' => 32, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 1100.00, 'image_url' => 'images/cattoy5.jpg', 'product_name' => 'Scratching Post Tower'],
            ['id' => 33, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 780.00, 'image_url' => 'images/cattoy6.jpg', 'product_name' => 'Laser Pointer Toy'],
            ['id' => 34, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 890.00, 'image_url' => 'images/cattoy7.jpg', 'product_name' => 'Spring Jumping Cat Toy'],
            ['id' => 35, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 970.00, 'image_url' => 'images/cattoy8.webp', 'product_name' => 'Interactive Puzzle Feeder'],
            ['id' => 36, 'pet_type' => 'Cat', 'accessories_type' => 'Toy', 'price' => 1200.00, 'image_url' => 'images/cattoy9.jpg', 'product_name' => 'Hanging Door Cat Toy'],
        ];

        $now = now();
        foreach ($products as &$product) {
            $product['created_at'] = $now;
            $product['updated_at'] = $now;
        }

        DB::table('pets')->insert($products);
    }
}
