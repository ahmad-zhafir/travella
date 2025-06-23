<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('listings', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID column
        $table->string('title'); // Title of the listing
        $table->text('description'); // Description of the listing
        $table->decimal('price', 8, 2); // Price of the listing (up to 999999.99)
        $table->string('location'); // Location of the listing
        $table->unsignedBigInteger('user_id'); // Foreign key to users table
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
        $table->timestamps(); // Created at and Updated at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
