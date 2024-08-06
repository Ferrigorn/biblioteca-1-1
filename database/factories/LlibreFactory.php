<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LlibreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = 'portadas/' . $this->faker->image(storage_path('app/public/portadas'), 400, 300, null, false);
    {
        return [
            'titol' => fake()->title(),
            'autor' => fake()->name(),
            'editorial' => fake()->company(),
            'anyEdicio' => fake()->year(),
            'genere' => fake()->randomElement(['Negra', 'Narrativa', 'Historica', 'Assaig', 'Biografia', 'Historia', 'Politica', 'Filosofia']),
            'ubicacio' => fake()->randomElement(['Menjador', 'Despatx', 'Passadís', 'Hab.Papes', 'Hab.Ferriol', 'Hab.Irene']),
            'idioma' => fake()->randomElement(['Catala', 'Castella']),
            // 'deixat' => fake()->boolean(),
            'coleccio' => fake()->word(),
            'portada' => $imagePath,
        ];
    }

    }
}
