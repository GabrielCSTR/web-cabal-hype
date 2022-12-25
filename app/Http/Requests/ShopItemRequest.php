<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopItemRequest extends FormRequest
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
            'Name'          => ['required', 'string', 'min:4', 'max:20'],
            'Description'   => ['required', 'string', 'min:4', 'max:255'],
            'ItemIDX'       => ['required', 'string', 'max:20'],
            'OptionIDX'     => ['required', 'string', 'max:20'],
            'Duration'      => ['required', 'string', 'max:20'],
            'Image'         => ['required'],
            'Stock'         => ['required', 'string', 'max:20'],
            'Price'         => ['required', 'string', 'max:20'],
            'category'      => ['required', 'string'],
        ];
    }
}
