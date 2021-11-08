<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string',
            'email' => 'email',
            'cpf' => 'string|min:11|max:14', //EX:999.999.999-99
            'rg' => 'string|min:8|max:13', //EX:MG-99.999.999
            'phone' => 'nullable|string|min:11|max:15', //EX:(99) 99999-9999
            'address' => "nullable|string",
            'birth_date' => 'date_format:d-m-Y'
        ];
    }
}
