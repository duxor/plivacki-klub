<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DodajTakmicara extends Request
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
            'ime'=>'required',
            'prezime'=>'required',
            'registracioni_broj'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'ime.required' => 'Ime je obavezno polje za unos.',
            'prezime.required' => 'Prezime je obavezno polje za unos.',
            'registracioni_broj.required' => 'Registracioni broj je obavezno polje za unos.',
        ];
    }
}
