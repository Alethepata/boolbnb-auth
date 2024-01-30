@extends('layouts.admin')

@section('content')
    <h1>Lista appartamenti</h1>
    {{-- Vista Desktop  --}}
    <table class="table list w-100">
        <thead>
            <tr>
                <th scope="col">Appartamento</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Sponsorizzazione</th>
                <th scope="col">Modifica</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apartments as $apartment)
                <tr>
                    <td>{{ $apartment->title }}</td>
                    <td>{{ $apartment->address }}</td>
                    <td>
                        @if (count($apartment->sponsors) > 0)
                            @foreach ($apartment->sponsors as $sponsor)
                                @if (!empty($sponsor->plan_title))
                                    <span class="badge rounded-pill text-bg-success">{{ $sponsor->plan_title }}</span>
                                @endif
                            @endforeach
                        @else
                            <span class="badge rounded-pill text-bg-warning">Non sponsorizzato</span>
                        @endif
                    </td>


                    <td>
                        <a class="btn btn-dark" href="{{ route('admin.apartments.show', $apartment) }}"><i
                                class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                        <a class="btn btn-dark" href="{{ route('admin.apartments.edit', $apartment) }}"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <form class="d-inline-block" action="{{ route('admin.apartments.destroy', $apartment) }}"
                            method="POST"
                            onsubmit="return confirm ('Sei sicuro di voler eliminare questo appartamento dalla tua lista?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Fine Vista Desktop  --}}
    {{-- Vista Mobile  --}}
    @foreach ($apartments as $apartment)
        <div class="card card-m" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->address }}</p>
                <span>
                    @if (count($apartment->sponsors) > 0)
                        @foreach ($apartment->sponsors as $sponsor)
                            @if (!empty($sponsor->plan_title))
                                <span class="badge rounded-pill text-bg-success">{{ $sponsor->plan_title }}</span>
                            @endif
                        @endforeach
                    @else
                        <span class="badge rounded-pill text-bg-warning">Non sponsorizzato</span>
                    @endif
                </span>
                <div class="action">
                    <a class="btn" href="{{ route('admin.apartments.show', $apartment) }}"><i
                            class="fa-solid fa-circle-info" style="color: #ffffff;"></i></a>
                    <a class="btn" href="{{ route('admin.apartments.edit', $apartment) }}"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <form class="d-inline-block" action="{{ route('admin.apartments.destroy', $apartment) }}"
                        method="POST"
                        onsubmit="return confirm ('Sei sicuro di voler eliminare questo appartamento dalla tua lista?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Fine Vista Mobile  --}}
@endsection
