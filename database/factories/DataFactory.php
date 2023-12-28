<?php

namespace Database\Factories;

use App\Models\Data;
use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFactory extends Factory
{
    protected $model = Data::class;

    public function definition()
    {
        $contentIds = Content::pluck('id')->toArray();

        return [
            'content_id' => $this->faker->randomElement($contentIds),
            'key' => $this->faker->word,
            'value' => $this->faker->sentence,
        ];
    }
}