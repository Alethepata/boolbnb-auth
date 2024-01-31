@extends('layouts.admin')
@section('content')
    <h1>Messaggi</h1>
    {{-- Versione desktop --}}
    <div class="container-list">

        @if (count($messages) > 0)
            <table class="table t-desktop">
                <thead>
                    <tr class="col-pers">
                        <th scope="col">Email</th>
                        <th scope="col">Data</th>
                        <th scope="col">In riferimento a</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr class="tr-pers">
                            <td class="td-pers">{{ $message->email }}</td>
                            @php
                                $date = $message->created_at->diffForHumans();
                            @endphp
                            <td class="td-pers">{{ $date }}</td>
                            <td class="td-pers">{{ $message->apartment->title }}</td>
                            <td>
                                <a class="btn btn-pers" href="{{ route('admin.messages.show', $message) }}"><i
                                        class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>Nessun messaggio ricevuto</h3>
        @endif
        {{-- Fine Versione desktop --}}
        {{-- Versione Mobile  --}}
        <div class="contain-m">
            @foreach ($messages as $message)
                <div class="mex">
                    <a class="btn" href="{{ route('admin.messages.show', $message) }}">
                        <tr>
                            <td class="email">{{ $message->email }}</td> |
                            @php
                                $date = $message->created_at->diffForHumans();
                            @endphp
                            <td class="app">{{ $message->apartment->title }}</td> |
                            <td class="date">{{ $date }}</td>
                        </tr>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Fine Versione Mobile  --}}
@endsection
