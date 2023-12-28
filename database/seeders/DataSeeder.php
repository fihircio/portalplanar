<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Data;
use App\Models\Content;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming you have at least one content item
        $contentIds = Content::pluck('id')->toArray();

        foreach ($contentIds as $contentId) {
            Data::factory()->count(2)->create([
                'content_id' => $contentId,
                'entry_key' => Str::random(10), // Generate a random entry_key
                'key' => $faker->word,
                'value' => $faker->sentence,
                ]);
        }
    }
}
