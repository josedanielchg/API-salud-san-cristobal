<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = News::class;

    public function definition()
    {
        $body = $this->faker->text($maxNbChars = 2000);

        return [
            'body' => $body,
            'abstract' => substr($body, 0, 100) . "...",
            'title' => $this->faker->sentence(4, true),
        ];
    }
}
