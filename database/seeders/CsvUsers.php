<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class CsvUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso del file CSV
        $csvFile = storage_path('app/csv/db_utenti.csv');
        // $faker = Faker::create();

        // Usa la libreria league/csv per leggere il CSV
        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0); // Imposta la prima riga come header


        // Itera sulle righe del CSV e popola il database
        foreach ($csv->getRecords() as $record) {
            // Adatta questa parte in base alla tua struttura CSV e del database
            DB::table('users')->insert([
                'name' => $record['Nome'],
                'surname' => $record['Cognome'],
                'date_of_birth' => Carbon::createFromFormat('d/m/y', $record['Data di Nascita'])->format('Y-m-d'),
                'email' => $record['Email'],
                'password' => $record['Password'],
            ]);
        }
    }
}
