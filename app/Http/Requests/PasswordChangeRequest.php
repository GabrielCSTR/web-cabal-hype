<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'password'                  => ['required', 'string', 'min:6', 'confirmed', 'regex:/^[a-z\d_]{4,15}+$/i'],
            'password_confirmation'     => ['required', 'string', 'min:6', 'same:password', 'regex:/^[a-z\d_]{4,15}+$/i'],
        ];
    }

    public function messages()
    {
        return [
            'password.confirmed'    => 'os campos de Senha não estão iguais, verifique sua senha e tente novamente.',
            'password.regex'        => 'Campo Senha requer apenas letras/numeros, não utilize acentuações ou espaço, a senha requer no minimo 4 caracteres e no máximo 15.',
        ];
    }
}
