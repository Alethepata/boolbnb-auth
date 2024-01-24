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

    {{-- GRAFICO --}}
    <div>
        <canvas id="myChart"></canvas>
    </div>



    {{-- SCRIPT DEL GRAFICO --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');


        // FORMAT VIEWS
        const views = @json($apartment->views);

        console.log(views);

        const viewGen = 0
        const viewFeb = 0
        const viewMar = 0
        const viewApr = 0
        const viewMag = 0
        const viewGiu = 0
        const viewLug = 0
        const viewAgo = 0
        const viewSet = 0
        const viewOtt = 0
        const viewNov = 0
        const viewDic = 0

        for (let i = 0; i < views.length; i++) {

            viewDate = new Date(views[i].date).getMonth();

            console.log(viewDate);

            switch (viewDate) {
                case 0:
                    viewGen += 1;
                    break;
                case 1:
                    viewFeb += 1;
                    break;
                case 2:
                    viewMar += 1;
                    break;
                case 3:
                    viewApr += 1;
                    break;
                case 4:
                    viewMag += 1;
                    break;
                case 5:
                    viewGiu += 1;
                    break;
                case 6:
                    viewLug += 1;
                    break;
                case 7:
                    viewAgo += 1;
                    break;
                case 8:
                    viewSet += 1;
                    break;
                case 9:
                    viewOtt += 1;
                    break;
                case 10:
                    viewNov += 1;
                    break;
                case 11:
                    viewDic += 1;
                    break;
            }
        }


        // FORMAT DATA
        const currentDate = new Date();

        let month;

        function formatDate(n) {

            currentDate.setMonth(currentDate.getMonth() - n);

            month = currentDate.toLocaleString('it-IT', {
                month: 'short',
                year: 'numeric'
            })

            return month;
        }


        // GRAFICO
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [formatDate(11),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                    formatDate(-1),
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [],
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
