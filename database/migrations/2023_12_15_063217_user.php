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
       Schema::create('users', function (Blueprint $table) {
           $table->id();
           $table->string('username', 256);
           $table->string('email', 256);
           $table->string('password', 256);
           $table->enum('user_type', ['admin', 'accountant', 'user'])->default('user');
           $table->timestamps(); 
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
