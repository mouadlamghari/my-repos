<?php

namespace Database\Seeders;

use App\Models\Typeoperation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Operation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Typeoperation::factory(10)->create();
    }
}
