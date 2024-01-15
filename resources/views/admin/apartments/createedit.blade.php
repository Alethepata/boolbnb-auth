@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $title }}</h1>

        <form enctype="multipart/form-data" action="{{ $route }}" method="POST">

            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'appartamento</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Numero di stanze</label>
                <input type="number" class="form-control" id="rooms" name="rooms">
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Numero di letti</label>
                <input type="number" class="form-control" id="beds" name="beds">
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Numero di bagni</label>
                <input type="number" class="form-control" id="bathrooms" name="bathrooms">
            </div>
            <div class="mb-3">
                <label for="square-meters" class="form-label">Metri quadrati</label>
                <input type="number" class="form-control" id="square-meters" name="square_meters">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="municipality" class="form-label">Comune</label>
                <input type="text" class="form-control" id="municipality" name="municipality">
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Provincia</label>
                <input type="text" class="form-control" id="province" name="province">
            </div>
            <div class="mb-3">
                <label for="postal-code" class="form-label">CAP</label>
                <input type="number" class="form-control" id="postal-code" name="postal_code">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control" id="image" name="img">
            </div>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="is_visible" value="1" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_visible" value="0" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Non visibile
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>

    </div>
@endsection
