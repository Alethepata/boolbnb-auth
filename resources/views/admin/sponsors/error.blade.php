@extends('layouts.admin')

@section('content')
<div class="container text-center mt-5" id='braintreeErrorRiderictPageContainer'>
    <h1 class="mb-5">{{$message}}</h1>
    <div class="alert alert-danger" role="alert">
        <span>Qualcosa è andato storto nel pagamento, <a href="{{route('admin.sponsors.index')}}">Riprova</a></span>
    </div>
</div>

@endsection
