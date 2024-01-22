<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Data;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // Create and associate content with users
        $users = \App\Models\User::all();
        
        

        foreach ($users as $user) {
            Content::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        }

          // Fetch all data with entry_key
        $dataEntries = Data::pluck('entry_key')->toArray();

        foreach ($dataEntries as $dataEntry) {
             // Check if the entry_key already exists in Content
             $existingContent = Content::where('entry_key', $dataEntry)->first();

             // Create Content only if the entry_key doesn't exist
             if (!$existingContent) {
                 Content::factory()->create([
                     'entry_key' => $dataEntry,

                ]);
            }
        }
    }
}
