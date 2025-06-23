<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['listing_id', 'path'];
    
    // Define the relationship with the Listing model
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
