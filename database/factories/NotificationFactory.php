<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(4, true),
            'body' => $this->faker->text($maxNbChars = 1000),
            'seen' => $this->faker->numberBetween(0,1),
        ];
    }
}
