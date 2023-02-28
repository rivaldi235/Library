<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 5; $i++) { 
            $catalog = new Catalog;

            $catalog->name = $faker->unique()->randomElement(['Novel', 'biography', 'religion', 'history', 'technology']);

            $catalog->save();
        }
    }
}
