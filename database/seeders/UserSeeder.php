<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ensure to include the User model
use Illuminate\Support\Facades\Hash; // To hash passwords

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can use factory or manually insert records
        User::create([
            'name' => 'Tiger Nixon',
            'email' => 'test@gmail.com',
            'password' => Hash::make('123456'),
            //'status' => 'System Architect',
            'address' => 'Edinburgh',
            'referral_code' => 'dfsadrfh',
        ]);

        // User::create([
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com',
        //     'password' => Hash::make('password123'),
        //    // 'position' => 'Software Engineer',
        //     'address' => 'New York',
        // ]);

    }
}
