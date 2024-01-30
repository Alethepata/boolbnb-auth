@extends('layouts.admin')
@section('content')
    <h1>Messaggi</h1>
    {{-- Versione desktop --}}
    <table class="table t-desktop">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Data</th>
                <th scope="col">In riferimento a</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->email }}</td>
                    @php
                        $date = $message->created_at->diffForHumans();
                    @endphp
                    <td>{{ $date }}</td>
                    <td>{{ $message->apartment->title }}</td>
                    <td>
                        <a class="btn btn-pers" href="{{ route('admin.messages.show', $message) }}"><i
                                class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
    {{-- Fine Versione Mobile  --}}
@endsection
