@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $title }}</h1>

        <form enctype="multipart/form-data" action="{{ $route }}" method="POST">

            @csrf
            @method($method)

            <div class="mb-3">
                <label for="title" class="form-label @error('title') is-invalid @enderror">Nome dell'appartamento *</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $apartment?->title) }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label @error('rooms') is-invalid @enderror">Numero di stanze *</label>
                <input type="number" class="form-control" id="rooms" name="rooms"
                    value="{{ old('rooms', $apartment?->rooms) }}">
                @error('rooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label @error('beds') is-invalid @enderror">Numero di letti *</label>
                <input type="number" class="form-control" id="beds" name="beds"
                    value="{{ old('beds', $apartment?->beds) }}">
                @error('beds')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label @error('bathrooms') is-invalid @enderror">Numero di bagni *</label>
                <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                    value="{{ old('bathrooms', $apartment?->bathrooms) }}">
                @error('bathrooms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square-meters" class="form-label @error('square_meters') is-invalid @enderror">Metri quadrati
                    *</label>
                <input type="number" class="form-control" id="square-meters" name="square_meters"
                    value="{{ old('square_meters', $apartment?->square_meters) }}">
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label @error('address') is-invalid @enderror">Indirizzo *</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $apartment?->address) }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('img') is-invalid @enderror">Immagine *</label>
                <input type="file" class="form-control" id="image" name="img"
                    value="{{ old('img', $apartment?->img) }}">
                <div class="image-container mt-3">
                    <p>Antemprima immagine:</p>
                    <img id="image-preview" width="300" height="200" onerror="this.src='/img/placeholder.png'"
                        src="{{ asset('storage/' . $apartment?->img) }}" alt="">
                </div>
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="visible mb-3">
                <p class="@error('is_visible') is-invalid @enderror">Visibilità *</p>

                <div class="d-flex">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="is_visible" value="1"
                            id="flexRadioDefault1" @if (old('is_visible', $apartment?->is_visible)) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Visibile
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" value="0"
                            id="flexRadioDefault2" @if (old('is_visible', $apartment?->is_visible)) checked @endif>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Non visibile
                        </label>
                    </div>
                </div>
                @error('is_visible')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="services mb-3">
                <p class="@error('services') is-invalid @enderror">Servizi *</p>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($services as $service)
                        <input type="checkbox" class="btn-check" id="service-{{ $service->id }}" name="services[]"
                            value="{{ $service->id }}" autocomplete="off"
                            @if ($apartment?->services->contains($service)) checked @endif>
                        <label class="btn btn-outline-primary"
                            for="service-{{ $service->id }}">{{ $service->title }}</label>
                    @endforeach
                </div>
                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>

    <script>
        function imagePreview(event) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
