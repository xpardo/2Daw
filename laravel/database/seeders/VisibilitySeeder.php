<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Visibility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class VisibilitySeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visibility::create(['id' => Visibility::PUBLIC,   'name' => 'public']);
        Visibility::create(['id' => Visibility::CONTACTS, 'name' => 'contacts']);
        Visibility::create(['id' => Visibility::PRIVATE,  'name' => 'private']);
    }
}
