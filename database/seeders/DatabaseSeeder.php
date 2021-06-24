<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->has(Film::factory()->count(4))->count(10)->create();
    }
}
