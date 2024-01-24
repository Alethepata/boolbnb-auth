<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;

//use Carbon\Carbon;

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

        $isPayed = true;

        $form_data = $request->all();

       // $apartment = Apartment::where('id', $form_data['apartment'])->get();

        //$uno = $apartment[0]['sponsors'];
        //[0]['id'];

        //$due = $uno['original'];



        //$apartment->sponsors()->attach($form_data['sponsor']);
        //$apartment[0]['sponsors']->attach($form_data['sponsor']);
        //dd($form_data['sponsor']);


        //$sponsors= new Sponsor();
        //$sponsors->apartments()->attach($form_data['apartment']);

        if($isPayed){

            //$dateTime= new \DateTime();
            //$curTime = $dateTime->format('Y-m-d H:i:s');

            //dd($curTime);
            $apartments= new Apartment();

            $apartments->id = $form_data['apartment'];

           // $apartments->ending_date = $curTime;

            $apartments->sponsors()->attach($form_data['sponsor']);
            //$apartments->ending_date()->attach($curTime);


            return redirect()->route('admin.sponsors.index')->with('success', 'Pagamento eseguito');

        }else{
            return redirect()->route('admin.sponsors.index')->with('error', 'Pagamento non riuscito');
        }
    }

    public function Success(Request $request){
        return view('admin.sponsors.succes');
    }
}
