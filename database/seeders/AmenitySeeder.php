<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create sample amenities
        Amenity::create([
            'name' => 'Swimming Pool'
        ]);

        Amenity::create([
            'name' => 'Gym'
        ]);

        Amenity::create([
            'name' => 'Parking'
        ]);

        Amenity::create([
            'name' => 'Elevator Access'
        ]);

        Amenity::create([
            'name' => 'Private Balcony'
        ]);

        Amenity::create([
            'name' => 'Washer & Dryer'
        ]);

        Amenity::create([
            'name' => 'Smart TV'
        ]);
        
        Amenity::create([
            'name' => 'Free Wi-Fi'
        ]);

        Amenity::create([
            'name' => 'Air Conditioning'
        ]);

        Amenity::create([
            'name' => 'Fully Equipped Kitchen'
        ]);
    }
}
