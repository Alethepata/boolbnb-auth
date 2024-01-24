<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment</title>
</head>
<body>
    <div id="dropin-container"></div>
    <button id="submit-button">Invia Pagamento</button>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var sponsor = '{{ $sponsor }}'; // Recupera il valore di sponsor dalla variabile PHP
        var apartment = '{{ $apartment }}'; // Recupera il valore di apartment dalla variabile PHP

        var button = document.getElementById('submit-button');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        braintree.dropin.create({
            authorization: '{{ $clientToken }}',
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
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
            sponsor: sponsor,
            apartment: apartment
        });

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);

                    // Controlla se il pagamento è riuscito
                    if (response.success) {
                        // Esegui il redirect alla rotta /payment-success
                        window.location.href = '/payment-success?sponsor=' + sponsor + '&apartment=' + apartment;
                    }
                } else {
                    console.error('Errore nella richiesta:', xhr.status);
                }
            }
        };

        xhr.send(data);
    }
    });
    </script>
</body>
</html>
