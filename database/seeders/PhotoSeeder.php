<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Photo::create([
            'path' => 'uploads/image8.jpg',
            'listing_id' => 3,
        ]);

        Photo::create([
            'path' => 'uploads/image9.jpg',
            'listing_id' => 3,
        ]);

        Photo::create([
            'path' => 'uploads/image10.jpg',
            'listing_id' => 3,
        ]);

                Photo::create([
            'path' => 'uploads/image11.jpg',
            'listing_id' => 3,
        ]);

    }
}
