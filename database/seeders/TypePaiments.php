<?php

namespace Database\Seeders;

use App\Models\Typepaiment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypePaiments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Typepaiment::create(['typepaiment'=>'Liquide']);
        Typepaiment::create(['typepaiment'=>'chèque']);
        Typepaiment::create(['typepaiment'=>'dépôt']);
    }
}
