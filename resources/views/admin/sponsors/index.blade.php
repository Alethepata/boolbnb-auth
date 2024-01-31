@extends('layouts.admin')

@section('content')
    <div class="container c-all">
        <div class="container-fluid text-center">
            <h1>Sponsorizza appartamento</h1>
        </div>
        {{-- Messaggio
        <div class="row row-cols-1">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="col">
                <div id="alert">
                    <p id="alert-message"></p>
                </div>
            </div>
        </div> --}}

        {{-- Form --}}
        <div class="row row-cols-1">
            <div class="col">
                <form method="GET" action="{{ route('dropin') }}" id="form">
                    @csrf
                    {{-- Piani --}}
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="container c-desktop  my-5">
                                @foreach ($sponsors as $sponsor)
                                    <div class="card card-pers text-center mb-3 mx-3" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $sponsor->plan_title }}</h5>
                                            <p class="card-text">Durata sponsorizzazione: {{ $sponsor->duration }} ore</p>
                                            <p class="card-text">Prezzo: {{ $sponsor->price }} &euro;</p>
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input" type="radio" name="sponsor"
                                                    id="sponsor-button-{{ $sponsor->id }}" value="{{ $sponsor->id }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- Seleziona appartamento --}}
                        <div class="container-select">
                            <!-- <label for="apartmentSelect"  class="text-center">Seleziona un appartamento</label> -->
                            <h5 class="text-center mb-3">Seleziona un appartamento</h5>
                            <select class="form-select" aria-label="Default select example" name="apartment"
                                id="apartmentSelect">
                                <option selected>Nessun appartamento selezionato</option>
                                @foreach ($apartments as $apartment)
                                    <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </form>
                {{-- Button --}}
                <div class="row justify-content-center mt-3" id="submitButtonRow" style="display:none;">
                    <div class="send">
                        <button type="submit" class="btn btn-pers" id="btn">Invia</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('apartmentSelect').addEventListener('change', function() {
            var selectedValue = this.value;
            var submitButtonRow = document.getElementById('submitButtonRow');

            // Mostra/nascondi il pulsante in base alla selezione
            if (selectedValue !== 'Seleziona un appartamento') {
                submitButtonRow.style.display = 'flex';
            } else {
                submitButtonRow.style.display = 'none';
            }

        });


        let sponsorButton1 = document.getElementById('sponsor-button-1');
        let sponsorButton2 = document.getElementById('sponsor-button-2');
        let sponsorButton3 = document.getElementById('sponsor-button-3');
        let alert = document.getElementById('alert');
        let alertMessage = document.getElementById('alert-message');
        let form = document.getElementById('form');
        let btn = document.getElementById('btn');

        let message;
        const sponsor = [];

        sponsorButton1.addEventListener('click', function() {

            message = '';
            alertMessage.innerHTML = message;
            alert.className = '';

            if (!sponsor.includes(this.value)) {
                sponsor.pop();
                sponsor.push(this.value);
            }

        })

        sponsorButton2.addEventListener('click', function() {
            message = '';
            alertMessage.innerHTML = message;
            alert.className = '';
            if (!sponsor.includes(this.value)) {
                sponsor.pop();
                sponsor.push(this.value);
            }
        })

        sponsorButton3.addEventListener('click', function() {
            message = '';
            alertMessage.innerHTML = message;
            alert.className = '';
            if (!sponsor.includes(this.value)) {
                sponsor.pop();
                sponsor.push(this.value);
            }

        })

        btn.addEventListener('click', function() {
            if (sponsor.length > 0) {
                form.submit();
            } else {
                message = 'Selezionare lo sponsor';
                alertMessage.innerHTML = message;
                alert.className = 'alert alert-danger';
            }
        })
    </script>
@endsection
