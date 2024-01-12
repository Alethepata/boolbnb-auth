<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Wifi', 'Piscina', 'Parcheggio gratuito', 'Vasca', 'Lavatrice', 'Self check-in', 'TV', 'Animali ammessi', 'Palestra', 'Aria condizionata', 'Ascensore', 'Accesibilità per disabili', 'Giardino', 'Balcone', 'Asciugacapelli'];

        foreach ($data as $service) {
            $new_service = new Service();
            $new_service->title = $service;
            $new_service->save();
        }
    }
}
