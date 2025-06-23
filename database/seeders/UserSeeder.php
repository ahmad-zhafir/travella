<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a new user
        User::create([
            'name' => 'Muhammad Ali',
            'email' => 'ali@gmail.com',
            'password' => bcrypt('travella123'), // Hash the password
            'role' => 'host', // Assign a role
        ]);

        // Optionally, create additional users
        User::create([
            'name' => 'Muhammad Abu',
            'email' => 'abu@gmail.com',
            'password' => bcrypt('travella123'),
            'role' => 'guest',
        ]);
    }
}
