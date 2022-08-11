<?php

namespace Database\Factories;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymptomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Symptom::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3, true),
        ];
    }
}
