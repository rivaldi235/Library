<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 30; $i++) { 
            $publisher = new Publisher;

            $publisher->name = $faker->name;
            $publisher->email = $faker->email;
            $publisher->phone_number = '0821'.$faker->randomNumber(8);
            $publisher->address = $faker->address;

            $publisher->save();
        }
    }
}
