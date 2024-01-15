<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = null;
        $route = route('admin.apartments.store');
        $method = 'POST';
        $title = 'Aggiungi nuovo appartamento';
        return view('admin.apartments.createedit', compact('title', 'route', 'method', 'apartment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $new_apartment = new Apartment();

        if (array_key_exists('img', $form_data) && $form_data['img'] != "") {
            $form_data['img_name'] = $request->file('img')->getClientOriginalName();
            $form_data['img'] = Storage::put('uploads', $form_data['img']);
        }

        $new_apartment->fill($form_data);

        $new_apartment->slug = Apartment::generateSlug($request->title);

        // $apiUrl = 'https://api.tomtom.com/search/2/geocode/';

        // $apiKey = 'key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l';

        // $response   = Http::post('https://api.tomtom.com/search/2/geocode/Via&Ostilia,23&00184.json?key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l');

        // $jsonData = $response->json();

        // dd($jsonData);

        // $client = new Client();

        // try {
        //     $response = $client->get($apiUrl, [
        //         'headers' => [
        //             'Address' => 'Via&Ostilia,23&00184',
        //             'Authorization' => 'Bearer' . $apiKey,
        //         ]
        //     ]);

        //     $data = json_decode($response->getBody(), true);

        //     return response()->json($data);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // };

        $new_apartment->save();

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $route = route('admin.apartments.update', $apartment);
        $method = 'PUT';
        $title = 'Modifica appartamento';
        return view('admin.apartments.createedit', compact('apartment', 'title', 'route', 'method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $form_data = $request->all();

        $apartment->fill($form_data);

        $apartment->save();

        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
