<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['nullable','min:2', 'max:45'],
            'surname' => ['nullable','min:2', 'max:45'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_of_birth' => ['nullable','date','before_or_equal:' . now()->subYears(18)->format('d-m-Y')],

        ],
        [
            'name.min' => 'Il nome deve avere minimo :min lettere ',
            'name.max' => 'Il nome deve avere massimo :max lettere ',
            'surname.min' => 'Il cognome deve avere minimo :min lettere ',
            'surname.max' => 'Il cognome deve avere massimo :max lettere ',
            'email.required' => 'Inserire l\'email',
            'email.lowercase' => 'L\'email deve essere scritta tutta in minuscolo',
            'email.unique' => 'L\'indirizzo email esiste',
            'email.max' => 'L\'email deve avere massimo :max lettere ',
            'password.required' => 'Inserire la password',
            'password.min' => 'La password deve avere minimo :min caratteri ',
            'password.max' => 'La password deve avere massimo :max caratteri ',
            'password.confirmed' => 'Le password non sono uguali ',
            'date_of_birth.before_or_equal' => 'Devi avere almeno 18 anni per registrarti.',
        ]);


        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);

        return redirect('admin');
    }
}
