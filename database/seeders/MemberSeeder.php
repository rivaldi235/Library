<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0; $i < 30; $i++)
        {
            $member = new Member;

            $gender = $faker->randomElement(['M', 'F']);

            $member->name = $faker->name($gender);
            $member->gender = $gender;
            $member->phone_number = '0838'.$faker->randomNumber(8);
            $member->address = $faker->address;
            $member->email = $faker->email;

            $member->save();
        }
    }
}
