<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'rooms' => ['required' , 'min:1' , 'max:100'],
            'beds' => ['required' , 'min:1' , 'max:100'],
            'bathrooms' => ['required' , 'min:1' , 'max:100'],
            'square_meters'=>['required', 'min:10' , 'max:1000'],
            'address'=> ['required', 'min:2'],
            'img'=>['required'],
            'is_visible'=>['required']
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Devi inserire il titolo',
            'title.min' => 'Il titolo deve avere un minimo di :min',
            'title.max' => 'Il titolo deve avere un massimo di :max',
            'rooms.required' => 'Devi inserire il numero di stanze',
            'rooms.min' => 'Le stanze devono avere un minimo di :min',
            'rooms.max' => 'Le stanze possono avere un massimo di :max',
            'beds.required' => 'Devi inserire i posti letto',
            'beds.min' => 'I posti letto devono avere un minimo di :min',
            'beds.max' => 'I posti letto possono essere massimo :max',
            'bathrooms.required' => 'Devi inserire il bagno ',
            'bathrooms.min' => 'Il bagni devono essere un minimo di :min',
            'bathrooms.max' => 'I bagni possono essere un massimo di :max',
            'square_meters.required' => 'Devi inserire i metri quadri',
            'square_meters.min' => 'I metri quadri devono avere un minimo di :min ',
            'square_meters.max' => 'I metri quadri possono avere un massimo di :max',
            'address.required' => 'Devi inserire una residenza',
            'address.min' => 'La residenza deve avere un minimo di :min caratteri ',
            'img.required' => 'Devi inserire una foto',
            'is_visible.required' => 'Devi inserire questo campo',




        ];
    }
}
