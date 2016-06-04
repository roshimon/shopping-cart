<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CartFormRequest extends Request
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
            'email' => 'required|email',
            'name' => 'required|min:3',
            'address1' => 'required|min:5',
            'address2' => 'min:5',
            'city' => 'required|min:5',
            'postal_code' => 'required|min:5',
        ];
    }
}
