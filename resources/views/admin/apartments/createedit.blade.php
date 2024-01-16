@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $title }}</h1>

        <form enctype="multipart/form-data" action="{{ $route }}" method="POST">

            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label">Nome dell'appartamento</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $apartment?->title) }}" required autocomplete="title">
            </div>
            <div class="mb-3">
                <label for="rooms" class="form-label">Numero di stanze</label>
                <input type="number" class="form-control" id="rooms" name="rooms"
                    value="{{ old('rooms', $apartment?->rooms) }}" required autocomplete="rooms" min="1"
                    max="100">
            </div>
            <div class="mb-3">
                <label for="beds" class="form-label">Numero di letti</label>
                <input type="number" class="form-control" id="beds" name="beds"
                    value="{{ old('beds', $apartment?->beds) }}" required autocomplete="beds" min="1" max="100">
            </div>
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Numero di bagni</label>
                <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                    value="{{ old('bathrooms', $apartment?->bathrooms) }}" required autocomplete="bathrooms" min="1"
                    max="100">
            </div>
            <div class="mb-3">
                <label for="square-meters" class="form-label">Metri quadrati</label>
                <input type="number" class="form-control" id="square-meters" name="square_meters"
                    value="{{ old('square_meters', $apartment?->square_meters) }}" required autocomplete="square_meters"
                    min="1" max="1000">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $apartment?->address) }}" required autocomplete="address">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control" id="image" name="img"
                    value="{{ old('img', $apartment?->img) }}" required autocomplete="img">
            </div>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="is_visible" value="1" id="flexRadioDefault1"
                        required autocomplete="is_visible" @if (old('is_visible', $apartment?->is_visible)) checked @endif>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_visible" value="0" id="flexRadioDefault2"
                        @if (old('is_visible', $apartment?->is_visible)) checked @endif>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Non visibile
                    </label>
                </div>
            </div>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($services as $service)
                    <input type="checkbox" class="btn-check" id="service-{{ $service->id }}" name="services[]"
                        value="{{ $service->id }}" autocomplete="off" @if ($apartment?->services->contains($service)) checked @endif>
                    <label class="btn btn-outline-primary"
                        for="service-{{ $service->id }}">{{ $service->title }}</label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection
