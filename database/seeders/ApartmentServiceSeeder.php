<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $apartment = Apartment::inRandomOrder()->first();
        // $service_id = Service::inRandomOrder()->first()->id;

        // $apartment->services()->attach($service_id);

        $apartments = Apartment::all();
        foreach($apartments as $apartment)
            DB::table('apartment_service')->insert([
                'apartment_id' => $apartment->id,
                'service_id' => Service::inRandomOrder()->first()->id
            ]);
    }
}
