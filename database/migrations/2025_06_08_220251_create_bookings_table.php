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
        Schema::create('bookings', function (Blueprint $table) {
        $table->id(); // Auto-incrementing primary key
        $table->date('startDate'); // Start date of the booking
        $table->date('endDate'); // End date of the booking
        $table->enum('status', ['booked', 'cancelled', 'completed'])->default('booked'); // Status of the booking (default is booked)
        $table->enum('availability', ['yes', 'no'])->default('no'); // Availability (default is no)
        $table->string('name');
        $table->string('contact_no');
        $table->string('email');
        $table->decimal('total_price', 10, 2);
        $table->integer('days');
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to the users table
        $table->foreignId('listing_id')->constrained()->onDelete('cascade'); // Foreign key to the listings table
        $table->timestamps(); // Created at and Updated at timestamps
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
