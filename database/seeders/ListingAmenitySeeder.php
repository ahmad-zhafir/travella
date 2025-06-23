<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Amenity;

class ListingAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Option 1: Find the listing by ID
        $listing = Listing::find(3); // Find listing by ID

        // Option 2: Find the listing by other attributes (e.g., by title)
        // $listing = Listing::where('title', 'Modern Apartment')->first();

        // If the listing exists, proceed with attaching amenities
        if ($listing) {
            // Attach amenities by their IDs directly (no need to fetch by name)
            $listing->amenities()->attach(1); // Example: Attach amenity with ID 1 (Swimming Pool)
            $listing->amenities()->attach(3); // Example: Attach amenity with ID 2 (Gym)
            $listing->amenities()->attach(8); // Example: Attach amenity with ID 3 (Parking)
            $listing->amenities()->attach(9);
            $listing->amenities()->attach(5);
            $listing->amenities()->attach(7);
        }
    }
}
