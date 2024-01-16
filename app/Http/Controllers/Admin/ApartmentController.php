<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Requests\ApartmentRequest;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $apartments = Apartment::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
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
        $services = Service::all();
        $title = 'Aggiungi nuovo appartamento';
        return view('admin.apartments.createedit', compact('title', 'route', 'method', 'apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentRequest $request)
    {
        $form_data = $request->all();
        $new_apartment = new Apartment();

        if (array_key_exists('img', $form_data) && $form_data['img'] != "") {
            $form_data['img_name'] = $request->file('img')->getClientOriginalName();
            $form_data['img'] = Storage::put('uploads', $form_data['img']);
        }

        $new_apartment->fill($form_data);

        $new_apartment->user_id = Auth::id();

        $new_apartment->slug = Apartment::generateSlug($request->title);

        $address_api = $form_data['address'];

        $apiUrl = 'https://api.tomtom.com/search/2/geocode/';

        $apiKey = 'key=5SpDBwX41WJf17bsPmyNJnysKu2nuS3l';

        $response = file_get_contents($apiUrl . str_replace(' ', '&', $address_api) . '.json?' . $apiKey);

        $response_decode = json_decode($response, true);

        $new_apartment->latitude = $response_decode['results'][0]['position']['lat'];

        $new_apartment->longitude = $response_decode['results'][0]['position']['lon'];

        $new_apartment->save();

        if (array_key_exists('services', $form_data)) {
            $new_apartment->services()->attach($form_data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {

        if (Auth::check() && Auth::id() === $apartment->user_id) {

            return view('admin.apartments.show', compact('apartment'));
        } else {

            return abort(404, 'Non sei autorizzato a visualizzare questo appartamento.');
        }
        // return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $route = route('admin.apartments.update', $apartment);
        $method = 'PUT';
        $services = Service::all();
        $title = 'Modifica appartamento';
        if (Auth::check() && Auth::id() === $apartment->user_id) {

            return view('admin.apartments.createedit', compact('apartment', 'title', 'route', 'method', 'services'));
        } else {

            return abort(404, 'Non sei autorizzato a visualizzare questo appartamento.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->all();

        $apartment->slug = Apartment::generateSlug($form_data['title']);

        if (array_key_exists('img', $form_data)) {
            if ($apartment->img) {
                Storage::disk('public')->delete($apartment->img);
            }
            $form_data['img_name'] = $request->file('img')->getClientOriginalName();

            $form_data['img'] = Storage::put('uploads', $form_data['img']);
        }


        $apartment->update($form_data);


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
