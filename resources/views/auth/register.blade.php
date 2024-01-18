@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" id="form">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" >

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}">

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p id="result"></p>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }} </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                    </form>
                    <div class="mb-4 row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button class="btn btn-primary" id="btn">
                                {{ __('Registrati') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    const form = document.getElementById('form');
    let password = document.getElementById('password');
    let dateOfBirth = document.getElementById('date_of_birth');
    let passwordConfirm = document.getElementById('password-confirm');
    const result = document.getElementById('result');
    const btn = document.getElementById('btn');

    //TODO: SISTEMARE DATE

    btn.addEventListener('click', function(){
        let passwordValue = password.value;
        let passwordConfirmValue = passwordConfirm.value;
        const correct=validatePassword(passwordValue, passwordConfirmValue);
        // let yearValue = date_of_birth.value.substring(0,4);
        // let monthValue = date_of_birth.value.substring(5,7);
        // let dateValue = date_of_birth.value.substring(8,10);
        // const correctDay = validateDate(yearValue,monthValue,dateValue);
        let message;

        function validatePassword(firstvalue,secondvalue){
           if(firstvalue === secondvalue){

            return true;
           }

        }
        // function validateDate(firstvalue,secondvalue,thirdvalue){
        //     cost d = new Date();
        //     let day = d.getDate();
        //     let year = d.getFullYear();
        //     let month = d.getMonth();

        //     const prova = year - firstvalue;

        //     console.log(prova)

        // }
        if(correct){
            message ='giusto';
            form.submit()

        }else{
            message ='errate';
        }

        console.log(passwordConfirmValue)


        result.innerHTML = message;


    })

</script>
@endsection
