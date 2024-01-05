<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['resort', 'homestay']); // Enum column for category
            $table->string('image')->nullable(); // Assuming the image path will be stored
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Assuming price is a decimal with 8 digits in total and 2 decimal places
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
};
