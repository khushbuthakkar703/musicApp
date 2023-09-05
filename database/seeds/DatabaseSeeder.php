<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i<20; $i++){
            /*DB::table('music_types')->insert([
                'name' => $faker->word
            ]);*/
        }

    	for($i = 0; $i<200; $i++){
        DB::table('music_campaigns')->insert([
            'campaign_name' => $faker->company,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'company_name' => $faker->company,
            'country' => $faker->country,
            'state' => $faker->state,
            'city' => $faker->city,
            'street' => $faker->city,
            'zipcode' => str_random(5),
            'phone' => $faker->phoneNumber,
            'spin_rate' => mt_rand(10,100),
            'likes' => mt_rand(100000, 999999),
            'dislikes' => mt_rand(100000, 999999),
            'total_spin' => mt_rand(1000000, 99999999),
            'email' => $faker->unique()->email,
            'bpm' => mt_rand(100,9999),
            'genre' => mt_rand(1,10)
            

        ]);
    }
    }
}
