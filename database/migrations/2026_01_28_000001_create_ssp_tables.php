<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Pets table
        // 1. Pets table
        if (!Schema::hasTable('pets')) {
            Schema::create('pets', function (Blueprint $table) {
                $table->id();
                $table->string('pet_type', 50);
                $table->string('accessories_type', 50);
                $table->decimal('price', 10, 2);
                $table->string('image_url', 255)->nullable();
                $table->string('product_name', 100);
                $table->timestamps(); // created_at, updated_at (nullable by default in Laravel?) No, actually not nullable usually but helpful. 
                // Model says timestamps = false, but migration usually provides them. 
                // DB definition had created_at DATETIME NULL.
            });
        }

        // 2. favorites table
        if (!Schema::hasTable('favorites')) {
            Schema::create('favorites', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade'); // Assumes pets table exists from above
                $table->timestamps();
            });
        }

        // 3. cart table
        if (!Schema::hasTable('cart')) {
            Schema::create('cart', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }

        // 4. cart_items table
        if (!Schema::hasTable('cart_items')) {
            Schema::create('cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cart_id')->constrained('cart')->onDelete('cascade');
                $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
                $table->integer('quantity')->default(1);
                $table->timestamps();
                
                // Add unique constraint if needed, logic seemed to imply it
                $table->unique(['cart_id', 'pet_id']);
            });
        }

        // 5. orders table
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('status', 50)->nullable();
                
                // Shipping fields from the SQL dump
                $table->string('shipping_address', 255)->nullable();
                $table->string('shipping_city', 100)->nullable();
                $table->string('shipping_province', 100)->nullable();
                $table->string('shipping_zip', 20)->nullable();
                $table->string('shipping_phone', 20)->nullable();
                $table->string('payment_method', 50)->nullable();
                $table->decimal('subtotal', 10, 2)->nullable();
                $table->decimal('tax', 10, 2)->nullable();
                $table->decimal('total', 10, 2)->nullable();

                $table->timestamps();
            });
        }

        // 6. order_items table
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
                $table->integer('quantity');
                $table->decimal('price', 10, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('pets');
    }
};
