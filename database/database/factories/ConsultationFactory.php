<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'NumeroConsultation' => fake()->unique()->randomNumber(),
        'Objet' => fake()->sentence,
        'Observation' => fake()->word,
        'Date_consultation' => fake()->date,
        'patient_id' => 1,
        'TypeCosultation' => fake()->randomElement(['operation', 'Consultationgénéral']),
        ];
    }
}
