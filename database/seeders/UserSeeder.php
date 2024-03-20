<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
         // Create users
         User::factory(10)->create()->each(function ($user) {
            // Assign 'staff' role to each user
            $staffRole = Role::where('name', 'staff')->first();
            $user->role()->associate($staffRole);
            $user->save();
        });
    }
}
