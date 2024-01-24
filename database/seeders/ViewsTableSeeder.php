<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\View;
use App\Models\Apartment;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "date" => '2023-01-24',
                "ip_address" => '151.54.149.51',
            ],
            [

                "date" => '2023-01-28',
                "ip_address" => '151.54.149.52',
            ],
            [

                "date" => '2023-01-30',
                "ip_address" => '151.54.149.53',
            ],
            [
                "date" => '2023-02-24',
                "ip_address" => '151.54.149.54',
            ],
            [

                "date" => '2023-02-14',
                "ip_address" => '151.54.149.55',
            ],
            [

                "date" => '2023-03-14',
                "ip_address" => '151.54.149.56',
            ],
            [
                "date" => '2023-03-24',
                "ip_address" => '151.54.149.57',
            ],
            [

                "date" => '2023-03-28',
                "ip_address" => '151.54.149.58',
            ],
            [

                "date" => '2023-04-02',
                "ip_address" => '151.54.149.59',
            ],
            [
                "date" => '2023-04-12',
                "ip_address" => '151.54.149.60',
            ],
            [

                "date" => '2023-05-24',
                "ip_address" => '151.54.149.61',
            ],
            [

                "date" => '2023-05-25',
                "ip_address" => '151.54.149.62',
            ],
            [
                "date" => '2023-06-10',
                "ip_address" => '151.54.149.63',
            ],
            [

                "date" => '2023-06-24',
                "ip_address" => '151.54.149.64',
            ],
            [

                "date" => '2023-07-10',
                "ip_address" => '151.54.149.65',
            ],
            [
                "date" => '2023-07-12',
                "ip_address" => '151.54.149.66',
            ],
            [

                "date" => '2023-07-28',
                "ip_address" => '151.54.149.68',
            ],
            [

                "date" => '2023-07-29',
                "ip_address" => '151.54.149.69',
            ],
            [
                "date" => '2023-08-08',
                "ip_address" => '151.54.149.70',
            ],
            [

                "date" => '2023-08-15',
                "ip_address" => '151.54.149.71',
            ],
            [

                "date" => '2023-08-22',
                "ip_address" => '151.54.149.72',
            ],
            [
                "date" => '2023-08-23',
                "ip_address" => '151.54.149.73',
            ],
            [

                "date" => '2023-09-04',
                "ip_address" => '151.54.149.74',
            ],
            [

                "date" => '2023-09-14',
                "ip_address" => '151.54.149.75',
            ],
            [
                "date" => '2023-10-24',
                "ip_address" => '151.54.149.76',
            ],
            [

                "date" => '2023-11-27',
                "ip_address" => '151.54.149.77',
            ],
            [

                "date" => '2023-11-29',
                "ip_address" => '151.54.149.78',
            ],
            [
                "date" => '2023-12-24',
                "ip_address" => '151.54.149.79',
            ],
            [

                "date" => '2023-12-25',
                "ip_address" => '151.54.149.80',
            ],
            [
                "date" => '2024-01-14',
                "ip_address" => '151.54.149.81',
            ],
            [

                "date" => '2023-01-24',
                "ip_address" => '151.54.149.82',
            ]
        ];

        foreach ($data as $view) {
            $new_view = new View();
            $new_view->apartment_id = Apartment::inRandomOrder()->first()->id;
            $new_view->date = $view['date'];
            $new_view->ip_address = $view['ip_address'];

            $new_view->save();
        }
    }
}
