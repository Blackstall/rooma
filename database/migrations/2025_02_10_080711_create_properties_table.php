<?php
// database/migrations/2023_01_01_000000_create_properties_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users');
            $table->string('title');
            $table->enum('type', ['sale', 'rent']);
            $table->decimal('price', 12, 2);
            $table->boolean('is_price_negotiable')->default(false);
            $table->text('description');
            $table->json('amenities')->nullable();
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->boolean('furnished')->default(false);
            $table->boolean('featured')->default(false);
            $table->dateTime('featured_until')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('price');
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};