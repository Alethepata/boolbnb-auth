<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Apartment;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_message = new Message();
        $new_message->apartment_id = Apartment::inRandomOrder()->first()->id;
        $new_message->message = "Buongiorno volevo più info sull'appartamento";
        $new_message->email = "info@example.com";
        $new_message->name = "Gino";
        $new_message->surname = "Bellissimo";
        $new_message->save();
    }
}
