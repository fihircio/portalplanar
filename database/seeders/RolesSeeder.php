<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
  
    public function run(): void
    {
        Role::create(['role_name' => 'admin']);
        Role::create(['role_name' => 'staff']);
    }
}
