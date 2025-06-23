<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;


class ListingSeeder extends Seeder
{
    public function run()
    {
        // Find the user by their email
        $user = User::find(1);

        // If the user exists, create listings for them
        if ($user) {
            // Create a new listing
            Listing::create([
                'title' => 'Cozy Studio in Kuala Lumpur City Centre',
                'description' => 'A stylish urban retreat steps from KLCC, this studio offers a peaceful space to unwind after exploring the bustling city. Enjoy modern comfort with city views and quick access to public transport and dining.',
                'price' => 250, // Price in currency
                'location' => 'Kuala Lumpur',
                'user_id' => $user->id, // Associate the listing with the specified user
                'bedrooms' => 1,  // Set the number of bedrooms
                'bathrooms' => 1, // Set the number of bathrooms
            ]);

            // Create another listing for the same user
            Listing::create([
                'title' => 'Beachside Chalet in Langkawi',
                'description' => 'Tucked along a quiet beach, this traditional chalet promises peace and sea breezes. A private veranda offers a perfect place to enjoy morning coffee with ocean views.',
                'price' => 200,
                'location' => 'Kedah',
                'user_id' => $user->id, // Associate with the specified user
                'bedrooms' => 3,  // Set the number of bedrooms
                'bathrooms' => 2, // Set the number of bathrooms
            ]);

            Listing::create([
                'title' => 'Modern Apartment with City View in Johor Bahru',
                'description' => 'With panoramic views of Johor Bahru’s skyline, this modern apartment offers stylish comfort for both work and play. Located near shopping malls and the causeway to Singapore.',
                'price' => 190,
                'location' => 'Johor',
                'user_id' => $user->id, // Associate with the specified user
                'bedrooms' => 3,  // Set the number of bedrooms
                'bathrooms' => 2, // Set the number of bathrooms
            ]);
        }
    }
}
