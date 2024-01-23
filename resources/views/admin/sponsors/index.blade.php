@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="container-fluid text-center my-5">
            <h1>Sponsorizza appartamento</h1>
        </div>
        {{-- Messaggio --}}
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
        </div>

{{-- Form --}}
<div class="row row-cols-1">
    <div class="col">
        <form method="POST" action="{{ route('admin.sponsors.store') }}">
            @csrf
            {{-- Piani --}}
            <div class="row row-cols-1">
                <div class="col">
                    <div class="container d-flex justify-content-center my-5">
                        @foreach ($sponsors as $sponsor)
                            <div class="card text-center mb-3 mx-3" style="width: 18rem;">
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
                <div class="col-6 offset-3">
                    <select class="form-select" aria-label="Default select example" name="apartment" id="apartmentSelect">
                        <option selected>Seleziona un appartamento</option>
                        @foreach ($apartments as $apartment)
                            <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            {{-- Button --}}
            <div class="row justify-content-center mt-3" id="submitButtonRow" style="display:none;">
                <div class="col-1">
                    <button type="submit" class="btn btn-primary" >Invia</button>
                </div>
            </div>

        </form>
    </div>
</div>

    </div>

    <script>
        document.getElementById('apartmentSelect').addEventListener('change', function () {
        var selectedValue = this.value;
        var submitButtonRow = document.getElementById('submitButtonRow');

        // Mostra/nascondi il pulsante in base alla selezione
        if (selectedValue !== 'Seleziona un appartamento') {
            submitButtonRow.style.display = 'flex';
        } else {
            submitButtonRow.style.display = 'none';
        }
        });
    </script>


@endsection
