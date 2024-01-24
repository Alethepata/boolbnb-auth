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

    {{-- GRAFICO VISUALIZZAZIONI --}}
    <div>
        <canvas id="myChart"></canvas>
    </div>


    {{-- SCRIPT DEL GRAFICO --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const ctx2 = document.getElementById('myChart2');
        const views = @json($apartment->views);
        const messages = @json($apartment->messages);

        // Inizializzo 2 array di 12 zeri
        let dataView = new Array(12).fill(0);
        let dataMessages = new Array(12).fill(0);

        function fillData(arrayData, datas) {
            // Ciclo messaggi / views
            for (let data of datas) {
                // Ottengo la data della view o messaggio
                let date = new Date(data.created_at);

                // Calcolo l'indice nell array di dati in base al mese e all'anno corrente
                let now = new Date();
                let months = (now.getFullYear() - date.getFullYear()) * 12 + now.getMonth() - date.getMonth();
                let index = 11 - months;

                // Incremento il conteggio per quel mese
                if (index >= 0 && index < 12) {
                    arrayData[index]++;
                }

                return arrayData;
            }
        }

        fillData(dataView, views);
        fillData(dataMessages, messages);




        // FORMAT DATE
        let currentDate;
        let monthYear;

        function formatDate(n) {

            currentDate = new Date();

            currentDate.setMonth(currentDate.getMonth() - n);

            monthYear = currentDate.toLocaleString('it-IT', {
                month: 'short',
                year: 'numeric'
            })

            return monthYear;
        }



        // GRAFICO VISUALIZZAZIONI
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [formatDate(11),
                    formatDate(10),
                    formatDate(9),
                    formatDate(8),
                    formatDate(7),
                    formatDate(6),
                    formatDate(5),
                    formatDate(4),
                    formatDate(3),
                    formatDate(2),
                    formatDate(1),
                    formatDate(0),
                ],
                datasets: [{
                        label: 'Visualizzazioni',
                        data: [
                            dataView[0],
                            dataView[1],
                            dataView[2],
                            dataView[3],
                            dataView[4],
                            dataView[5],
                            dataView[6],
                            dataView[7],
                            dataView[8],
                            dataView[9],
                            dataView[10],
                            dataView[11],
                            dataView[12],
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Messaggi',
                        data: [
                            dataMessages[0],
                            dataMessages[1],
                            dataMessages[2],
                            dataMessages[3],
                            dataMessages[4],
                            dataMessages[5],
                            dataMessages[6],
                            dataMessages[7],
                            dataMessages[8],
                            dataMessages[9],
                            dataMessages[10],
                            dataMessages[11],
                            dataMessages[12],
                        ],
                        borderWidth: 1
                    }
                ]
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
