<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Amenity extends Model
{
public function listings()
{
    return $this->belongsToMany(Listing::class, 'listing_amenity', 'amenity_id', 'listing_id');
}
}
