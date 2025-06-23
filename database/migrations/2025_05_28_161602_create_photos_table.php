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
    Schema::create('photos', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID
        $table->string('path'); // The path of the photo file (e.g., file name or URL)
        $table->foreignId('listing_id')->constrained()->onDelete('cascade'); // Foreign key to listings table
        $table->timestamps(); // Created at and Updated at timestamps
    });
}

public function down()
{
    Schema::dropIfExists('photos');
}
};
