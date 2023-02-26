<?php

namespace Database\Factories;

use App\Models\Estados;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente' => $this->faker->name,
            'cpf' => $this->faker->numerify('###########'),
            'data_nascimento' => $this->faker->date(),
            'endereco' => $this->faker->address,
            'estado_id' => Estados::factory(),
            'cidade' => $this->faker->city,
            'sexo' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}
