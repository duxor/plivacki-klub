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
            'godiste'=>'required|size:4',
            'norme_informacije'=>'alpha_num',
        ];
    }
     public function messages()
    {
        return [
            'takmicenje_naziv.required' => 'Naziv je obavezan za unos.',
            'norme_muski.required' => 'Obavezan unos normi.',
            'norme_zenski.required' => 'Obavezan unos normi.',
            'godiste.required' => 'Godište je obavezan unos.',
            'godiste.size'    => 'Godište :mora biti u formi: 1981.',
            'norme_informacije.alpha_num' => 'Informacije mogu sadržati slova i brojeve.',
        ];
    }
}
