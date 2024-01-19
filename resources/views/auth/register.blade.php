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
                                <div id="error-name"></div>
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
                                <div id="error-surname"></div>
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                 <p id="error-date"></p>
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
                                <p id="error-email"></p>
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
                                <p id="result"></p>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }} </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <p id="error-password-confirm"></p>
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
    let name = document.getElementById('name');
    let surname = document.getElementById('surname');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let passwordConfirm = document.getElementById('password-confirm');
    let dateOfBirth = document.getElementById('date_of_birth');
    let errorName = document.getElementById('error-name');
    let errorSurname = document.getElementById('error-surname');
    let errorDate = document.getElementById('error-date');
    let errorEmail = document.getElementById('error-email');
    let errorPasswordConfirm = document.getElementById('error-password-confirm');
    const result = document.getElementById('result');
    const btn = document.getElementById('btn');



    // name.addEventListener('blur', function(){
    //     let correctNameLengthMin= validateNameLengthMin(name);
    //     let correctNameLengthMax= validateNameLengthMax(name);
    //     let message;
    //     function validateNameLengthMin(value) {
    //     if(value.value.length >= 2) return true;
    //     }
    //     function validateNameLengthMax(value) {
    //     if(value.value.length <= 45) return true;
    //     }
    //     if(correctNameLengthMin){
    //         message = ''
    //     }else{
    //         message = 'Il nome deve avere minimo 2 lettere'
    //     };
    //     if(correctNameLengthMax){
    //         message = ''
    //     }else{
    //         message = 'Il nome deve avere massimo 45 lettere'

    //     }


    //     errorName.innerHTML = message;
    // });

    password.addEventListener('blur', function(){
        let correctPasswordLength =validatePasswordLength(password.value);
        let message;

        function validatePasswordLength(value){
            if(value.length >= 8) return true;
        }
        if(correctPasswordLength){
            message = '';
            password.className = 'form-control border-secondary-subtle';
        }else{
            message = 'Il numero minimo di caratteri è 8';
            result.className = 'text-danger';
            password.className = 'form-control border-danger';
        }
        result.innerHTML = message;
    });

    passwordConfirm.addEventListener('blur', function(){
        let passwordValue = password.value;
        let passwordConfirmValue = passwordConfirm.value;
        const correctPassword=validatePassword(passwordValue, passwordConfirmValue);

        let message;

        function validatePassword(firstvalue,secondvalue){
           if(firstvalue === secondvalue){

            return true;
           }

        }

        if(correctPassword){
            message ='';
            password.className = 'form-control border-secondary-subtle';
            passwordConfirm.className = 'form-control border-danger';
            //form.submit()

        }else{
            message ='Le password non corrispondono';
            result.className = 'text-danger';
            password.className = 'form-control border-danger';
            passwordConfirm.className = 'form-control border-danger';
        }

        result.innerHTML = message;


    });

    dateOfBirth.addEventListener('blur', function(){
        let yearValue = date_of_birth.value.substring(0,4);
        let monthValue = date_of_birth.value.substring(5,7);
        let dateValue = date_of_birth.value.substring(8,10);
        const correctDate = validateDate(yearValue,monthValue,dateValue);


        function validateDate(firstvalue, secondvalue, thirdvalue){

            const d = new Date();
            let day = d.getDate();
            let year = d.getFullYear();
            let month = d.toISOString().substring(5,7);

            let message ;
            if((year - firstvalue) > 18 || (year - firstvalue) == 18 && month>=secondvalue && day>=thirdvalue){
                return true;
            }else{
                return false;
            }

        }

        if(correctDate){
            message ='';
            dateOfBirth.className = 'form-control border-success';
            }else{
                message ='minorenne';
                errorDate.className = 'text-danger';
                dateOfBirth.className = 'form-control border-danger';
            }

            errorDate.innerHTML = message;
    });
    btn.addEventListener('click', function(){

        if (password.value.length === 0 ){
            message= 'compilare campo';
            result.className = 'text-danger';
            password.className = 'form-control border-danger';
            result.innerHTML = message;
        }else{
            message= '';
            password.className = 'form-control border-secondary-subtle';
            result.innerHTML = message;
        }
        if (passwordConfirm.value.length === 0 ){
            message= 'compilare campo';
            errorPasswordConfirm.className = 'text-danger';
            passwordConfirm.className = 'form-control border-danger';
            errorPasswordConfirm.innerHTML = message;
        }else{
            message= '';
            passwordConfirm.className = 'form-control border-secondary-subtle';
            errorPasswordConfirm.innerHTML = message;
        }
        if (email.value.length === 0 ){
            message= 'compilare campo';
            errorEmail.className = 'text-danger';
            email.className = 'form-control border-danger';
            errorEmail.innerHTML = message;
        }else{
            message= '';
            email.className = 'form-control border-secondary-subtle';
            errorEmail.innerHTML = message;
        }

        if(password.value.length > 0 && passwordConfirm.value.length > 0 && email.value.length > 0){
            form.submit()
        }




    })



</script>
@endsection
