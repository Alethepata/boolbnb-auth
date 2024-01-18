<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Location\Coordinate;
use Location\Distance\Vincenty;

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

    public function searchApartments($num_rooms, $num_beds, $latitude, $longitude, $radius, $services)
    {
        $servicesArray = explode(',', $services);
        $apartments = Apartment::where('rooms', '>=', $num_rooms)
            ->where('beds', '>=', $num_beds)
            ->whereHas('Services', function ($query) use ($servicesArray) {
                $query->whereIn('Services.id', $servicesArray);
            })
            ->get();

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
}
