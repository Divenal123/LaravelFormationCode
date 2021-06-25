<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ Film, Category };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->create();

        $ids = range(1, 10);

        Film::factory()->count(40)->create()->each(function ($film) use($ids) {
            shuffle($ids);
            $film->categories()->attach(array_slice($ids, 0, rand(1, 4)));
        });
    }
}
