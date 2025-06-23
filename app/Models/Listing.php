<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Listing extends Model
{
    use HasFactory;

    // Define the fillable columns (to allow mass assignment)
    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'user_id',
        'bedrooms',  // Add bedrooms to the fillable array
        'bathrooms', // Add bathrooms to the fillable array
        'state',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function amenities()
{
    return $this->belongsToMany(Amenity::class, 'listing_amenity', 'listing_id', 'amenity_id');
}


    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function photos()
{
    return $this->hasMany(Photo::class);
}
public function firstPhoto()
{
    return $this->hasOne(Photo::class)->oldestOfMany();
}

public function isOwnedBy($user)
{
    return $this->user_id === $user->id;
}

public function scopeActive($query)
{
    return $query->where('state', 'active');
}

}
