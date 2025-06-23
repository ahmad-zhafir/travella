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
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // Auto-incrementing ID column
        $table->string('name'); // Name column
        $table->string('email')->unique(); // Email column with unique constraint
        $table->string('password'); // Password column
        $table->string('role')->default('user'); // Role column with a default value
        $table->timestamps(); // Created at and Updated at timestamps
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
