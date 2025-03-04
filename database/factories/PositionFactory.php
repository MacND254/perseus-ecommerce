<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'roles_and_responsibilities' => $this->faker->sentences(3, true),
            'requirements' => $this->faker->sentences(3, true),
        ];
    }
}
