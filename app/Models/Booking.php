<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

        // The attributes that are mass assignable
    protected $fillable = [
        'startDate', 'endDate', 'status', 'availability',
        'user_id', 'listing_id', 'name', 'contact_no', 'email',
        'total_price', 'days'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Listing model
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
