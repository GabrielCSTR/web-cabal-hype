<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'ID' => ['required', 'string', 'min:4', 'max:20', 'unique:cabal_auth_table'/*, 'regex:/^[a-z\d_]{4,28}+$/i'*/],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:cabal_auth_table'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'/*, 'regex:/^[a-z\d_]{4,15}+$/i'*/],
            'password_confirmation'  => ['required', 'string', 'min:6', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'ID.min'        => 'Account ID deve ter no minimo 4 caracteres.',
            'ID.unique'     => 'O login que deseja utilizar já está sendo utilizado.',
            'ID.required'   => 'Informe o campo ID.',
            'email.min'     => 'Email deve ter no minimo 4 caracteres.',
            'email.unique'  => 'O e-mail que deseja usar já está sendo utilizado.',
            'email.required'  => 'Informe um e-mail valido.',
            'password.confirmed'  => 'os campos de Senha não estão iguais, verifique sua senha e tente novamente.',
            'ID.regex'       => 'Campo Login requer apenas letras/numeros, não utilize acentuações ou espaço, e o login requer no minimo 4 caracteres e no máximo 28',
            'password.regex' => 'Campo Senha requer apenas letras/numeros, não utilize acentuações ou espaço, a senha requer no minimo 4 caracteres e no máximo 15.',

        ];
    }
}
