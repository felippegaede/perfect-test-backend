<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'document' => ["required",Rule::unique('customers')->ignore($this->route('customer'))]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'unique' => 'O CPF informado já está cadastrado.'
        ];
    }
}
