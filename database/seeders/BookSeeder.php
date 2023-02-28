<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 30; $i++) { 
            $catalog = new Book;

            $catalog->isbn = $faker->randomNumber(9);
            $catalog->title = $faker->name;
            $catalog->year = rand(2010,2023);
            $catalog->publisher_id = rand(1,30);
            $catalog->author_id = rand(1,30);
            $catalog->catalog_id = rand(1,5);
            $catalog->qty = rand(10,20);
            $catalog->price = rand(10000,500000);
            

            $catalog->save();
        }
    }
}
