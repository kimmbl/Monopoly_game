<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$Hc0Gp5j0Yn5SKycPdTicCOgc/k/eVR.jliaoRRiWdSdUD79LPPKSK', // password 123123123
            'remember_token' => Str::random(10),
        ];
    }
}
