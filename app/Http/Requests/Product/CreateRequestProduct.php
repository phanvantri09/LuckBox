<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestProduct extends FormRequest
{
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
            'title' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Không để trống',
            'description.required' => 'Không để trống',
            'amount.required' => 'Không để trống',
            'price.required' => 'Không để trống',
        ];
    }
}
