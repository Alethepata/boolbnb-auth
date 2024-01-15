@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $apartment->title }}</h1>

        <p>{{ $apartment->address }}</p>

        <div class="image">
            <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
        </div>

        <div>
            <h3>Specifiche:</h3>

            <ul>
                <li>Camere: {{ $apartment->rooms }}</li>
                <li>Letti: {{ $apartment->beds }}</li>
                <li>Bagni: {{ $apartment->bathrooms }}</li>
                <li>Metri quadrati: {{ $apartment->square_meters }}m²</li>
            </ul>

            <h3>Servizi aggiuntivi:</h3>

            @forelse ($apartment->services as $service)
                <span>{{ $service->title }}</span>
            @empty
                <span>Non ci sono servizi aggiuntivi</span>
            @endforelse
        </div>
    </div>
@endsection
