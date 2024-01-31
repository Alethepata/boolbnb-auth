@extends('layouts.admin')

@section('content')
    <div class="container c-all">
        <div class="container-fluid text-center">
            <h1>Sponsorizza appartamento</h1>
        </div>
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
document.getElementById('apartmentSelect').addEventListener('change', function () {
    console.log('Change event triggered');
    updateSubmitButtonVisibility();
});

let sponsorButtons = document.querySelectorAll('.form-check-input');

sponsorButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        console.log('Radio button clicked');
        // Deseleziona tutti i radio button
        sponsorButtons.forEach(function (btn) {
            btn.checked = false;
        });

        // Seleziona il radio button cliccato
        button.checked = true;

        updateSubmitButtonVisibility();
    });

    // Aggiungi evento di click sulla card
    let card = button.closest('.card');
    card.addEventListener('click', function () {
        console.log('Card clicked');
        button.checked = true;
        updateSubmitButtonVisibility();
    });
});

function updateSubmitButtonVisibility() {
    console.log('Update visibility function called');
    var selectedValue = document.getElementById('apartmentSelect').value;
    var selectedSponsor = Array.from(sponsorButtons).find(btn => btn.checked);

    // Mostra/nascondi il pulsante in base alla selezione
    var submitButtonRow = document.getElementById('submitButtonRow');
    if (selectedValue !== 'Nessun appartamento selezionato' && selectedSponsor) {
        console.log('Displaying submit button');
        submitButtonRow.style.display = 'flex';
    } else {
        console.log('Hiding submit button');
        submitButtonRow.style.display = 'none';
    }
}

document.getElementById('btn').addEventListener('click', function () {
    console.log('Submit button clicked');
    event.preventDefault();
    // Aggiungiamo un alert per vedere se il click viene gestito
    // alert('Submit button clicked');
    // Commentiamo il form.submit() al momento per vedere se l'alert funziona
    form.submit();
});

    </script>
@endsection
