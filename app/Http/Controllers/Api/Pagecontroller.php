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

    public function searchApartments($latitude, $longitude, $radius)
    {

        $apartments = Apartment::all();

        $filtredApartments = [];

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
    }
}
