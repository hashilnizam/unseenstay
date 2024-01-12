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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_type_id');

            $table->string('name');
            $table->string('logo'); // Assuming the image path will be stored
            $table->string('image'); // Assuming the image path will be stored
            $table->string('location');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('status');
            $table->timestamps();


//foreign key constraints
            $table->foreign('property_type_id')->references('id')->on('property_types');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
