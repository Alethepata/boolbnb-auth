<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ApartmentSponsor extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 5; $i++){
            DB::table('apartment_sponsor')->insert([
                'apartment_id' => Apartment::inRandomOrder()->first()->id,
                'sponsor_id' => Sponsor::inRandomOrder()->first()->id,
                'ending_date'=>  $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d H:i:s')
            ]);
        }
    }
}
