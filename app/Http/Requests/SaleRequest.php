<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'customer_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required|integer',
            'status' => 'required',
            'discount' => 'nullable|regex:/^\d+(\,\d{1,2})?$/'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'integer' => 'A quantidade precisa ser um valor numérico inteiro.',
            'regex' => 'O preço precisa ser um valor numérico no formato 0,00.'
        ];
    }
}
