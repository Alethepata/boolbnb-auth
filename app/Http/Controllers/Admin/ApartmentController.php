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
            // $form_data['img_name'] = $request->file('img')->getClientOriginalName();
            // $form_data['img'] = Storage::put('uploads', $form_data['img']);
            $form_data['img_name'] = $request->file('img')->getClientOriginalName();

            // Percorso personalizzato nella cartella public/images/assets/apartment_images/
            $customPath = public_path('images/assets/apartment_images/');

            // Salva l'immagine nella cartella
            $request->file('img')->move($customPath, $form_data['img_name']);

            // Modifica il percorso nel campo img del form_data
            $form_data['img'] = 'images/assets/apartment_images/' . $form_data['img_name'];
        }

        $new_apartment->fill($form_data);

        if (!$new_apartment->img) {
            return redirect()->route('admin.apartments.create')->withInput()->with('error', 'Aggiungi foto');
        }

        $new_apartment->user_id = Auth::id();

        $new_apartment->slug = Apartment::generateSlug($request->title);

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
        if ($apartment->img) {
            Storage::disk('public')->delete($apartment->img);
        }
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
