@extends('layouts.admin');

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.sponsors.store') }}">
        @csrf
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
        <select class="form-select w-50" aria-label="Default select example" name="apartment">
            <option selected>Seleziona un appartamento</option>
            @foreach ($apartments as $apartment)
                <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary my-5">Submit</button>
    </form>
@endsection
