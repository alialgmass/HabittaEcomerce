<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userRole = Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
        User::create([
            'name' => 'ali',
            'email' => 'ali@gmail.com',
            'password' =>'12345678',
            'phone' => '01200242376',
            'email_verified_at' => now(),
            "language" => "ar",
            'type'=>'user',
            "device_token" => "123456789",
            "longitude" => "31.2357",
            "latitude" => "30.0444",
        ])->assignRole($userRole);
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'phone' => '01013014910',
            'email_verified_at' => now(),
            'country_code' => "+20",
            "language" => "ar",
            'type'=>'delivery',
            "device_token" => "123456789",
            "longitude" => "31.2357",
            "latitude" => "30.0444",
        ])->assignRole($adminRole);
    }
}
