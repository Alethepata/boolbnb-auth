@extends('layouts.admin')
@section('content')


<div class="d-flex justify-content-center my-5">
    <div class="card text-center w-50">
        <div class="card-header">
            {{$message->apartment->title}}
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$message->email}}</h5>
          <p class="card-text">{{$message->message}}</p>
        </div>
        <div class="card-footer text-body-secondary">
            @php
                $date = $message->created_at->format('d/m/Y H:i')
            @endphp
            {{$date}}
        </div>
    </div>
</div>




@endsection
