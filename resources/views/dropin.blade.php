<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Payment</title>
    @vite(['resources/js/app.js'])
</head>

<body>

    <div class="container my-5">
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

            braintree.dropin.create({
                authorization: '{{ $clientToken }}',
                container: '#dropin-container'
            }, function(createErr, instance) {
                button.addEventListener('click', function() {
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
