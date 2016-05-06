<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DodajRezultat extends Request
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
            'klupski_rezultati'=>'required',
            'sumarni_rezultati'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'takmicenje_naziv.required' => 'Naziv je obavezan za unos.',
            'klupski_rezultati.required' => 'Obavezan unos klupskih rezultata.',
            'sumarni_rezultati.required' => 'Obavezan unos sumarnih rezultata.',
        ];
    }
}
