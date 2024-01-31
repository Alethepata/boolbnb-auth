<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Message;
use App\Models\Result;
use App\Models\View;
use Location\Coordinate;
use Location\Distance\Vincenty;
use Carbon\Carbon;

//use Illuminate\Database\Query\Builder;


class Pagecontroller extends Controller
{

    public function apartments()
    {
        $apartments = Apartment::whereHas('Sponsors', function ($query) {
            $query->where('ending_date', '>', Carbon::now());
        })->get();


        foreach ($apartments as $apartment) {
            $apartment->img = asset($apartment->img);
        }


        return response()->json(compact('apartments'));
    }

    public function apartmentDetail($slug)
    {

        $apartment = Apartment::where('slug', $slug)->with('services')->first();

        $apartment->img = asset($apartment->img);

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
            $query = Apartment::with('Sponsors')
                ->where('rooms', '>=', $num_rooms)
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
            $query = Apartment::with('Sponsors');
            // var_dump($query);
        }
        // var_dump('query^');
        $apartments = $query->get();
        // dd($query,$apartments);

        // Debugging
        // dd($num_rooms, $num_beds, $latitude, $longitude, $radius, $services, $servicesArray);

        foreach ($apartments as $apartment) {
            $apartment->img = asset($apartment->img);
        }
        $filtredApartments = [];

        if ($latitude != 0 && $longitude != 0) {


            $baseCoordinate = new Coordinate($latitude, $longitude);

            foreach ($apartments as $apartment) {
                $apartment->load('Sponsors');
                $apartmentCoordinate = new Coordinate($apartment->latitude, $apartment->longitude);

                $calculator = new Vincenty();

                $distance = $calculator->getDistance($baseCoordinate, $apartmentCoordinate);

                if ($distance <= $radius * 1000) {
                    $result = new Result($apartment, $distance);
                    $filtredApartments[] = $result;
                }
            }

            return response()->json(compact('filtredApartments'));
        } else {

            foreach ($apartments as $apartment) {
                $filteredApartments[] = $apartment;
            }

            return response()->json(compact('filteredApartments'));
        }
    }

    public function sendMessage($apartment_id, $email, $message)
    {

        $new_message = new Message();

        $new_message->apartment_id = $apartment_id;
        $new_message->email = $email;
        $new_message->message = $message;

        $new_message->save();

        $success = true;

        return response()->json(compact('success'));
    }

    public function saveView($apartment_id, $ip_address)
    {

        $views = View::all();

        $ip_addresses = [];

        foreach ($views as $view) {
            array_push($ip_addresses, $view->ip_address);
        }

        if (!in_array($ip_address, $ip_addresses)) {
            $new_view = new View();

            $new_view->apartment_id = $apartment_id;
            $new_view->ip_address = $ip_address;
            $new_view->date = date('Y-m-d');

            $new_view->save();
        }
    }
}
