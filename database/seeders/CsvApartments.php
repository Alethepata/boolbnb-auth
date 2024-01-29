<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Apartment;
use App\Models\User;
use GuzzleHttp\Client;

class CsvApartments extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Percorso del file CSV
        $csvFile = public_path('csv/db_apartments.csv');
        // $faker = Faker::create();

        $imagePaths = glob(public_path('images/assets/apartment_images/*'));
        // dd($imagePaths, $randomImagePath);

        // Usa la libreria league/csv per leggere il CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Imposta la prima riga come header


            foreach ($csv->getRecords() as $record) {
            $randomImagePath = $imagePaths[array_rand($imagePaths)];
            $relativeUrl = str_replace(public_path(), '', $randomImagePath);
            $relativeUrl = str_replace('\\', '/', $relativeUrl);
            // dd($relativeUrl);


            DB::table('apartments')->insert([
                'user_id' => User::all()->random()->id,
                'title' => $record['Nome Descrittivo'],
                'slug' => Apartment::generateSlug($record['Nome Descrittivo']),
                'rooms' => $record['Numero di Camere'],
                'beds' => $record['Numero di Letti'],
                'bathrooms' => $record['Numero di Bagni'],
                'square_meters' => $record['Metri Quadrati'],
                'address' => $record['Indirizzo Completo'],
                'longitude' => $record['Longitudine'],
                'latitude' => $record['Latitudine'],
                'img_name'=> $record['Nome Descrittivo'],
                'img' => $relativeUrl,
                'is_visible' => true
            ]);
        }
    }
}
