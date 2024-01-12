<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "price" => 2.99,
                "plan_title" => 'Standard',
                "duration" => 24
            ],
            [
                "price" => 5.99,
                "plan_title" => 'Silver',
                "duration" => 72
            ],
            [
                "price" => 9.99,
                "plan_title" => 'Gold',
                "duration" => 144
            ]
        ];

        foreach ($data as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->plan_title = $sponsor['plan_title'];
            $new_sponsor->duration = $sponsor['duration'];

            $new_sponsor->save();
        }
    }
}
