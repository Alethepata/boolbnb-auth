@extends('layouts.admin')

@section('content')
        <h1>Benvenuto nella tua Dashboard !</h1>
        <div class="apartment-content">
            <h4>I tuoi appartamenti</h4>
            <div class="apartment d-flex flex-wrap gap-4 mt-4">
                @foreach ($apartments as $apartment)
                    <a href="{{route('admin.apartments.show', $apartment)}}">
                        <div class="card border-0">
                            <div class="card-image">
                                <img src="{{asset($apartment->img) }}"class="card-img-top rounded-3" alt="{{$apartment->title}}">
                            </div>
                            <div class="text-content p-3 text-center">
                                <h5>{{$apartment->title}}</h5>
                            </div>
                        </div>
                    </a>
                    @endforeach
            </div>
        </div>
@endsection
