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
        $csvFile = storage_path('app/csv/db_apartments.csv');
        // $faker = Faker::create();

        $imagePaths = glob(public_path('images/assets/apartment_images/*'));
        // dd($imagePaths);

        // Usa la libreria league/csv per leggere il CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Imposta la prima riga come header

        // dd($firstRow = $csv->fetchOne());
        $firstRow = $csv->fetchOne();

        // $coordinates = $this->getCoordinates($firstRow['Indirizzo Completo']);
            // Adatta questa parte in base alla tua struttura CSV e del database
            // DB::table('apartments')->insert([
                //     'user_id' => User::all()->random()->id,
                //     'title' => $firstRow['Nome Descrittivo'],
                //     'slug' => Apartment::generateSlug($firstRow['Nome Descrittivo']),
                //     'rooms' => $firstRow['Numero di Camere'],
                //     'beds' => $firstRow['Numero di Letti'],
                //     'bathrooms' => $firstRow['Numero di Bagni'],
                //     'square_meters' => $firstRow['Metri Quadrati'],
                //     'address' => $firstRow['Indirizzo Completo'],
            //     'longitude' => $firstRow['Latitudine'],
            //     'latitude' => $firstRow['Longitudine'],
            //     'img_name'=> $firstRow['Nome Descrittivo'],
            //     'img' => 'https://picsum.photos/200/300',
            //     'is_visible' => true
            // ]);
// $coordinates = $this->getCoordinates($record['Indirizzo Completo']);
            // Itera sulle righe del CSV e popola il database

            foreach ($csv->getRecords() as $record) {
            $randomImagePath = $imagePaths[array_rand($imagePaths)];


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
                'img' => 'assets/images/' . basename($randomImagePath),
                'is_visible' => true
            ]);
        }
    }
    // private function getCoordinates($address)
    // {
    //     $apiUrl = 'https://api.tomtom.com/search/2/geocode/';
    //     $apiKey = 'key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l';

    //     $client = new Client();
    //     $response = $client->get($apiUrl . urlencode($address) . '.json?' . $apiKey);

    //     $json_data = $response->getBody()->getContents();
    //     $data = json_decode($json_data);

    //     return [
    //         'lat' => $data->results[0]->position->lat,
    //         'lon' => $data->results[0]->position->lon,
    //     ];
    // }
}
