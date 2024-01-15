@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $title }}</h1>

        <form>
            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'appartamento</label>
                <input type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Numero di stanze</label>
                <input type="number" class="form-control" id="rooms">
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Numero di letti</label>
                <input type="number" class="form-control" id="beds">
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Numero di bagni</label>
                <input type="number" class="form-control" id="bathrooms">
            </div>
            <div class="mb-3">
                <label for="square-meters" class="form-label">Metri quadrati</label>
                <input type="number" class="form-control" id="square_meters">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address">
            </div>
            <div class="mb-3">
                <label for="municipality" class="form-label">Comune</label>
                <input type="text" class="form-control" id="municipality">
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Provincia</label>
                <input type="text" class="form-control" id="province">
            </div>
            <div class="mb-3">
                <label for="postal-code" class="form-label">CAP</label>
                <input type="number" class="form-control" id="postal-code">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="text" class="form-control" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
