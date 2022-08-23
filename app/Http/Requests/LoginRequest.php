<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'ID'        => ['required', 'string', 'min:3', 'max:20', 'exists:cabal_auth_table', 'regex:/^[a-z\d_]{3,28}+$/i'],
            'password'  => ['required', 'string', 'min:6', 'regex:/^[a-z\d_]{4,15}+$/i'],
        ];
    }

    public function messages()
    {
        return [
            'ID.min'         => 'Account ID deve ter no minimo 4 caracteres.',
            'ID.exists'      => 'Essa conta não existe em nosso servidor! Tente novamente!',
            'ID.regex'       => 'Campo Login requer apenas letras/numeros, não utilize acentuações ou espaço',
            'password.regex' => 'Campo Senha requer apenas letras/numeros, não utilize acentuações ou espaço',
        ];
    }
}
