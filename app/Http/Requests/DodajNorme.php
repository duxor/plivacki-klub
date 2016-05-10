<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DodajNorme extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'takmicenje_naziv'=>'required',
            'norme_muski'=>'required',
            'norme_zenski'=>'required',
            'godiste'=>'required',
        ];
    }
     public function messages()
    {
        return [
            'takmicenje_naziv.required' => 'Naziv je obavezan za unos.',
            'norme_muski.required' => 'Obavezan unos normi.',
            'norme_zenski.required' => 'Obavezan unos normi.',
            'godiste.required' => 'Godište je obavezan unos.',
            'godiste.size'    => 'Godište mora biti uneto.',
        ];
    }
}
