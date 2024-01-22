<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        $sponsors = Sponsor::all();
        return view('admin.sponsors.index', compact('sponsors', 'apartments'));
    }

    public function store(Request $request)
    {

        $form_data = $request->all();

        $apartment = Apartment::where('id', $form_data['apartment'])->get();


        $apartment->sponsors()->attach($form_data['sponsor']);


        return redirect()->route('admin.sponsors.index')->with('success', 'Pagamento eseguito');
    }
}
