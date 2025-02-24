<?php

namespace Database\Factories;

use App\Models\EjemplarLibro;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EjemplarLibro>
 */
class EjemplarLibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = EjemplarLibro::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->unique()->sentence,
            'autor' => $this->faker->name,
            'editorial' => $this->faker->company,
        ];
    }
}
