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
    Schema::table('listings', function (Blueprint $table) {
        $table->integer('bedrooms')->nullable();  // Add an integer column for bedrooms
        $table->integer('bathrooms')->nullable(); // Add an integer column for bathrooms
    });
}

public function down()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->dropColumn(['bedrooms', 'bathrooms']); // Remove the columns if rolling back
    });
}
};
