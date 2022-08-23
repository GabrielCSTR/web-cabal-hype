<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPointsCharRequest extends FormRequest
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
            'FOR' => ['required','integer'],
            'INT' => ['required', 'integer'],
            'DES' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            // 'FOR.required' => 'Informe o valor da FOR',
            // 'INT.required' => 'Informe o valor da INT',
            // 'DES.required' => 'Informe o valor da DES',

            'FOR.integer' => 'Atenção, digite apenas numeros no campo FOR',
            'INT.integer' => 'Atenção, digite apenas numeros no campo INT',
            'DES.integer' => 'Atenção, digite apenas numeros no campo DES',
        ];
    }
}
