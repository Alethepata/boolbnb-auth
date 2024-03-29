@extends('layouts.admin')

@section('content')

<div class="show-apartment">
    <div class="row">
        <div class="col">
            <div class="text-up">
                <h2>{{ $apartment->title }}</h2>
                <p>{{ $apartment->address }}</p>
            </div>
        </div>
    </div>
    <div class="row row-cols-2 align-items-center row-cols-xs-1">
        <div class="col">
            <div class="image">
                @if (substr($apartment->img, 0, 7) == 'uploads')
                <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
                @else
                <img src="{{ asset($apartment->img) }}" alt="{{ $apartment->title }}">
                @endif
            </div>
        </div>
            <div class="col">

                <div class="text-content">
                    <div class="text">
                        <div class="text-down">
                            <h2>{{ $apartment->title }}</h2>
                            <p>{{ $apartment->address }}</p>
                        </div>
                        <ul class="d-flex">
                            <li><i class="fa-solid fa-hospital"></i>
                                <div>{{ $apartment->rooms }}</div>
                            </li>
                            <li class="mx-3"><i class="fa-solid fa-bed"></i>
                                <div>{{ $apartment->beds }}</div>
                            </li>
                            <li><i class="fa-solid fa-bath"></i>
                                <div>{{ $apartment->bathrooms }}</div>
                            </li>
                            <li class="mx-3"><i class="fa-solid fa-ruler-combined"></i>
                                <div>{{ $apartment->square_meters }}m²</div>
                            </li>
                        </ul>
                    </div>
                    <div class="services-container">
                        <h5 class="servizi">Servizi aggiuntivi:</h5>
                        <span id="service-list"></span>
                    </div>
                </div>
                <div class="graphic-container ">
                    <h5>Statistiche dell' appartamento</h5>
                    {{-- GRAFICO VISUALIZZAZIONI E MESSAGGI --}}
                    <div class="graphic">
                        <canvas id="myChart" class="p-2 border rounded-3"></canvas>
                    </div>

                </div>
            </div>
        </div>


        {{-- SCRIPT DEL GRAFICO --}}

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const services = @json($apartment->services);
            const ctx = document.getElementById('myChart');
            const ctx2 = document.getElementById('myChart2');
            const views = @json($apartment->views);
            const messages = @json($apartment->messages);
            const servicesListHtml = document.getElementById('service-list');

            // funzione per i servizi

            function printServices() {
                serviceList = services.map(service => service.title);
                return serviceList.join(" - ");
            }

            servicesListHtml.innerHTML = printServices();

            console.log(printServices());
            // Inizializzo 2 array di 12 zeri
            let dataView = new Array(12).fill(0);
            let dataMessages = new Array(12).fill(0);

            // Ciclo  views
            for (let view of views) {
                // Ottengo la data della view
                let date = new Date(view.date);

                // Calcolo l'indice nell array di dati in base al mese e all'anno corrente
                let now = new Date();
                let months = (now.getFullYear() - date.getFullYear()) * 12 + now.getMonth() - date.getMonth();
                let index = 11 - months;

                // Incremento il conteggio per quel mese
                if (index >= 0 && index < 12) {
                    dataView[index]++;
                }
            }

            // Ciclo messaggi
            for (let message of messages) {
                // Ottengo la data del messaggio
                let date = new Date(message.created_at);

                // Calcolo l'indice nell array di dati in base al mese e all'anno corrente
                let now = new Date();
                let months = (now.getFullYear() - date.getFullYear()) * 12 + now.getMonth() - date.getMonth();
                let index = 11 - months;

                // Incremento il conteggio per quel mese
                if (index >= 0 && index < 12) {
                    dataMessages[index]++;
                }
            }




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
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>
    @endsection
