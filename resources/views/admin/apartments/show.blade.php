@extends('layouts.admin')

@section('content')
    <h1>{{ $apartment->title }}</h1>

    <p>{{ $apartment->address }}</p>

    <div class="image">

        @if (substr($apartment->img, 0, 7) == 'uploads')
            <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
        @else
            <img src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
        @endif

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
            <span class="badge text-bg-primary">{{ $service->title }}</span>
        @empty
            <span>Non ci sono servizi aggiuntivi</span>
        @endforelse
    </div>

    <p>{{ $apartment->views }}</p>

    {{-- GRAFICO --}}
    <div>
        <canvas id="myChart"></canvas>
    </div>



    {{-- SCRIPT DEL GRAFICO --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        const views = @json($apartment->views);


        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
