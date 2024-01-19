<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Location\Coordinate;
use Location\Distance\Vincenty;
use App\Models\Message;

class Pagecontroller extends Controller
{

    public function apartments()
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            $apartment->img = asset('storage/' . $apartment->img);
        }


        return response()->json(compact('apartments'));
    }

    public function apartmentDetail($slug)
    {

        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        $apartment->img = asset('storage/' . $apartment->img);

        return response()->json(compact('apartment'));
    }

    public function services()
    {
        $services = Service::all();

        return response()->json(compact('services'));
    }

    public function searchApartments($latitude, $longitude, $radius, $num_rooms = null, $num_beds = null, $services = null)
    {



        if ($num_rooms != null && $num_beds != null) {
            // var_dump('if stanze letti');
            $query = Apartment::where('rooms', '>=', $num_rooms)
                ->where('beds', '>=', $num_beds);
            if ($services != null) {
                // var_dump('if servizi eseguito');
                $servicesArray = explode(',', $services);
                $query->whereHas('services', function ($subquery) use ($servicesArray) {
                    $subquery->whereIn('services.id', $servicesArray);
                });
            }
        } else {
            // var_dump('if all');
            $query = Apartment::query();
            // var_dump($query);
        }
        // var_dump('query^');
        $apartments = $query->get();
        // dd($query,$apartments);

        // Debugging
        // dd($num_rooms, $num_beds, $latitude, $longitude, $radius, $services, $servicesArray);

        foreach ($apartments as $apartment) {
            $apartment->img = asset('storage/' . $apartment->img);
        }
        $filtredApartments = [];

        if ($latitude != 0 && $longitude != 0) {


            $baseCoordinate = new Coordinate($latitude, $longitude);

            foreach ($apartments as $apartment) {
                $apartmentCoordinate = new Coordinate($apartment->latitude, $apartment->longitude);

                $calculator = new Vincenty();

                $distance = $calculator->getDistance($baseCoordinate, $apartmentCoordinate);

                if ($distance <= $radius * 1000) {
                    $filteredApartments[] = $apartment;
                }
            }

            return response()->json(compact('filteredApartments'));
        } else {

            foreach ($apartments as $apartment) {
                $filteredApartments[] = $apartment;
            }

            return response()->json(compact('filteredApartments'));
        }
    }

    public function sendMessage($data)
    {
        $new_message = new Message();
        $new_message->apartment_id = '1';
        $new_message->email = $data['email'];
        $new_message->message = $data['message'];
        $new_message->save();

        return response()->json('il messaggio è stato inviato');
    }
}
