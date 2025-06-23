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
    Schema::create('listing_amenity', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID
        $table->foreignId('listing_id')->constrained()->onDelete('cascade'); // Foreign key to listings table
        $table->foreignId('amenity_id')->constrained()->onDelete('cascade'); // Foreign key to amenities table
        $table->timestamps(); // Created at and Updated at timestamps
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_amenity');
    }
};
