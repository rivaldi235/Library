<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 30; $i++) { 
            $transactionDetail = new TransactionDetail;

            $transactionDetail->transaction_id = rand(1, 30);
            $transactionDetail->book_id = rand(1, 30);
        	$transactionDetail->qty = rand(1, 10);

            $transactionDetail->save();
        }
    }
}
