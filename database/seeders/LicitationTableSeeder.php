<?php

namespace Database\Seeders;

use App\Models\Licitation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicitationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Licitation::factory()->count(10)->create();
    }
}
