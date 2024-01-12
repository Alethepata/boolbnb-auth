<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_apartment = new Apartment();
        $new_apartment->title = 'Incantevole appartamento romantico di Trastevere';
        $new_apartment->slug = Apartment::generateSlug($new_apartment->title);
        $new_apartment->rooms = 10;
        $new_apartment->beds = 5;
        $new_apartment->bathrooms = 5;
        $new_apartment->square_meters = 100;
        $new_apartment->address = 'Via Ostilia, 23 00184';
        $new_apartment->longitude = 12.495;
        $new_apartment->latitude = 41.88861;
        $new_apartment->img = 'https://a0.muscache.com/im/pictures/miso/Hosting-1066556446643823324/original/d1c2c796-16b7-4502-90d4-59bd2b8a9ef1.png?im_w=1200';
        $new_apartment->is_visible = true;

        $new_apartment->save();
    }
}
