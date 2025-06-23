<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   // Table associated with the model (optional if table name is plural of model name)
    protected $table = 'users';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'contact_no',
    ];

    // The attributes that should be hidden for arrays (for sensitive data like passwords)
    protected $hidden = [
        'password',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function listings()
{
    return $this->hasMany(Listing::class);
}

public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
