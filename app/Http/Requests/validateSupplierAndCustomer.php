<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateSupplierAndCustomer extends FormRequest
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
            'short_name' => 'required|unique:suppliers|max:30',
            'code' => 'required|unique:suppliers|max:10',
        ];
    }

    public function messages()
{
    return [
        'short_name.required' => 'Pole Krótka nazwa musi być uzupełnione',
        'short_name.unique' => 'Pole Krótka nazwa nie może się powtarzać',
        'short_name.max' => 'Pole Krótka nazwa nie może być dłuższe niż 30 znaków',
        'code.required' => 'Pole Kod musi być uzupełnione',
        'code.unique' => 'Pole Kod nie może się powtarzać',
        'code.max' => 'Pole Kod nie może być dłuższe niż 10 znaków',
    ];
}
}
