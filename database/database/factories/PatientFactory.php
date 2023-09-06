<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Numero'=>'A'.rand(3,5),
            'CIN'=>'A',
            'NOM'=>'e',
            'PRENOM'=>'rr',
            "Adresse"=>'rrr',
            'Tel'=>'44567',
            'Email'=>'gde@uu.bb'
        ];
    }
}
