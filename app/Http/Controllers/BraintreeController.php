<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Sponsor;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;

class BraintreeController extends Controller
{
    public function showDropInForm(Request $request)
    {
        // Recupera i valori del form da $request
        $sponsor_id = $request->input('sponsor');
        $sponsor = Sponsor::find($sponsor_id);
        $apartment_id = $request->input('apartment');
        $apartment = Apartment::find($apartment_id);

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return view('dropin', [
            'clientToken' => $clientToken,
            'sponsor' => $sponsor,
            'apartment' => $apartment,
        ]);
    }



    public function processPayment(Request $request)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);

        $nonce = $request->input('payment_method_nonce');
        $sponsor = $request->input('sponsor');
        $apartment = $request->input('apartment');


        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        function endingSponsor($value){
            $dateTime = new \DateTime;
            $date = $dateTime->format('Y-m-d H:i:s');
            if($value == 1){
               $duration = '+ 1 days';
            }else if($value == 2){
                $duration = '+ 3 days';
            }else if($value == 3){
                $duration = '+ 6 days';
            }
            $date_duration = date("Y-m-d H:i:s", strtotime($date.$duration));
            return $date_duration;
        }


        if ($result->success) {
            // Attach tra Sponsor e Apartment
            DB::table('apartment_sponsor')->insert([
                'apartment_id' => $apartment,
                'sponsor_id' => $sponsor,
                'ending_date' => endingSponsor($sponsor),
            ]);

            return response()->json(['success' => true, 'message' => 'Pagamento riuscito']);
        } else {
            // Se il pagamento fallisce, gestisci di conseguenza
            return response()->json(['success' => false, 'message' => 'Pagamento fallito']);
        }
    }

    public function showSuccess(Request $request){
        $apartment = $request->query('apartment');
        $sponsor = $request->query('sponsor');

        return view('admin.sponsors.success', [
            'message' => 'Pagamento riuscito!',
            'sponsor' => Sponsor::find($sponsor),
            'apartment' => Apartment::find($apartment),
        ]);
    }
    public function showError(Request $request){
        $apartment = $request->query('apartment');
        $sponsor = $request->query('sponsor');

        return view('admin.sponsors.error', [
            'message' => 'Pagamento Fallito :(',
        ]);
    }
}
