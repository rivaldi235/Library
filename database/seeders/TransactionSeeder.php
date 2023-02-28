<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 30; $i++) { 
            $transaction = new Transaction;

            $transaction->member_id = rand(1, 30);
            $transaction->date_start = $faker->dateTimeBetween('-6 days', 'now');
        	$transaction->date_end = $faker->dateTimeBetween('+2 days', '+8 days');
            $transaction->status = $faker->boolean(0, 1);

            $transaction->save();
        }
    }
}
