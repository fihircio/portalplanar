<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Data;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create users
        $user1 = User::factory()->admin()->create();
        $user2 = User::factory()->create();
        
       
        // Create content items assigned to specific users
        Content::factory()->create([
            'user_id' => $user1->id,
        ]);

        Content::factory()->create([
            'user_id' => $user2->id,
        ]);

        // Additional content items can be created as needed
        Content::factory(5)->create(); // Creates 5 content items with random user assignments

           // Create data items assigned to specific content
           Data::factory()->create([
            'content_id' => 1, // Assuming content_id 1 exists from the previous content seeder
            'key' => 'Data 1',
            'value' => 'Sample Value 1',
        ]);

        Data::factory()->create([
            'content_id' => 2, // Assuming content_id 2 exists from the previous content seeder
            'key' => 'Data 2',
            'value' => 'Sample Value 2',
        ]);

        // Additional data items can be created as needed
        Data::factory(5)->create(); // Creates 5 data items with random content assignments

    }
}
