<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class CrateRequestBoxProduct extends FormRequest
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
            'products' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'products.required' => 'Không để trống'
        ];
    }
}
