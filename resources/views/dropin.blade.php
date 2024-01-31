<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Payment</title>
    @vite(['resources/js/app.js'])
    <style>
#loader-container{
    height: 100vh;
}
#loader {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: block;
        margin:15px auto;
        position: relative;
        color: #000000;
        box-sizing: border-box;
        animation: animloader 2s linear infinite;
        }

        @keyframes animloader {
        0% {
            box-shadow: 14px 0 0 -2px,  38px 0 0 -2px,  -14px 0 0 -2px,  -38px 0 0 -2px;
        }
        25% {
            box-shadow: 14px 0 0 -2px,  38px 0 0 -2px,  -14px 0 0 -2px,  -38px 0 0 2px;
        }
        50% {
            box-shadow: 14px 0 0 -2px,  38px 0 0 -2px,  -14px 0 0 2px,  -38px 0 0 -2px;
        }
        75% {
            box-shadow: 14px 0 0 2px,  38px 0 0 -2px,  -14px 0 0 -2px,  -38px 0 0 -2px;
        }
        100% {
            box-shadow: 14px 0 0 -2px,  38px 0 0 2px,  -14px 0 0 -2px,  -38px 0 0 -2px;
        }
    }
    </style>
</head>

<body>
        <div id="loader-container" class="my-5 align-items-center justify-content-center container-fluid" style="display: none;">
            <div id="loader"></div>
        </div>

        <div class="container my-5" id='payment-container'>
            <div class="row row-cols-2">
                <div class="col p-5">
                    <div class="">Stai sponsorizzando <strong>{{ $apartment->title }}</strong> con il piano
                        <strong>{{ $sponsor->plan_title }}</strong>
                    </div>
                    <div>Prezzo: <strong>{{ $sponsor->price }} &euro;</strong></div>
                </div>
                <div class="col">
                    <div id="dropin-container" class=""></div>
                </div>
            </div>

            <div class="row justify-content-end mt-3">
                <div class="col-2">
                    <button id="submit-button" class="btn btn-primary w-100 ">Paga {{ $sponsor->price }} &euro;</button>

                </div>

            </div>
        </div>





    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var sponsor = '{{ $sponsor }}'; // Recupera il valore di sponsor dalla variabile PHP
            var apartment = '{{ $apartment }}'; // Recupera il valore di apartment dalla variabile PHP
            var sponsor_id = '{{ $sponsor->id }}';
            var apartment_id = '{{ $apartment->id }}';
            var button = document.getElementById('submit-button');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            var paymentContainer = document.getElementById('payment-container');
            var loader = document.getElementById('loader-container');


            braintree.dropin.create({
                authorization: '{{ $clientToken }}',
                container: '#dropin-container'
            }, function(createErr, instance) {
                button.addEventListener('click', function() {


            // Nascondi il pulsante e mostra il loader
                    paymentContainer.style.display = 'none';
                    loader.style.display = 'block';
                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.error(err);
                            return;
                        }
                        inviaPayloadAlServer(payload.nonce);
                    });
                });
            });

            function inviaPayloadAlServer(nonce) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/process-payment', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                var data = JSON.stringify({
                    payment_method_nonce: nonce,
                    sponsor: sponsor_id,
                    apartment: apartment_id
                });

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            console.log(response);

                            // Controlla se il pagamento è riuscito
                            if (response.success) {
                                // Esegui il redirect alla rotta /payment-success
                                window.location.href = '/payment-success?sponsor=' + sponsor_id +
                                    '&apartment=' + apartment_id;
                            } else {
                                window.location.href = '/payment-error';
                            }
                        } else {
                            window.location.href = '/payment-error';
                        }
                    }
                };

                xhr.send(data);
            }
        });
    </script>
</body>

</html>
