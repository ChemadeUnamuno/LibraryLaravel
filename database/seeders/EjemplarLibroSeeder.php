<?php

namespace Database\Seeders;

use App\Models\EjemplarLibro;
use Illuminate\Database\Seeder;

class EjemplarLibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EjemplarLibro::factory()->count(10)->create();
    }
}
