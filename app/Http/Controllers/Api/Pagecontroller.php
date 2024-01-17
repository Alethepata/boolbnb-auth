<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;

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

    // public function searchApartments($lat, $lon, $rooms, $beds, $dist, $services)
    // {
    //     $apartments = Apartment::where()
    // }


}
