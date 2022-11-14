<?php

namespace Database\Seeders;

use App\Models\Visibilities;
use Illuminate\Database\Seeder;

class VisibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visibilities::factory()->count(5)->create();
    }
}
