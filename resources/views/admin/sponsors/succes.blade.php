@extends('layouts.admin')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-5">{{$message}}</h1>
    <div class="alert alert-success" role="alert">
        <span>Complimenti! Hai sponsorizzato <strong>{{$apartment->title}}</strong> con il piano <strong>{{$sponsor->plan_title}}</strong></span>
    </div>
</div>

@endsection
