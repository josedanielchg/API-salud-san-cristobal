<?php

namespace Database\Factories;

use App\Models\Township;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_home' => $this->faker->phoneNumber(),
            'phone_mobile' => $this->faker->e164PhoneNumber(),
            'personal_id' => $this->faker->unique()->randomNumber(8, false),
            'address_1' => $this->faker->streetAddress(),
            'address_2' => $this->faker->secondaryAddress(),
            'hospital' => $this->faker->optional()->sentence(3, true),
            'admin' => $this->faker->numberBetween(0,1),
            'disease' => $this->faker->optional()->randomElement(['covid-19', 'variante', 'viruela'], 1),
            'under_age' => $this->faker->numberBetween(0,1),
            'township_id' => Township::all()->random()->id,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
