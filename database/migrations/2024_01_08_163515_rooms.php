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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('property_id');
            $table->string('description');
            $table->int('person');
            $table->string('view');
            $table->string('image');
            $table->string('price');
            $table->string('status');
            $table->timestamps();


//foreign key constraints
            $table->foreign('room_type_id')->references('id')->on('room_types');
            $table->foreign('property_id')->references('id')->on('properties');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
