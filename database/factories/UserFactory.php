<?php

namespace FireBender\Laravel\PictureWorks\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use FireBender\Laravel\PictureWorks\Models\User;

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
        $faker = $this->withFaker();

        return [
            'name' => $faker->name(),
            'comments' => $faker->realText(),
        ];
    }
}
