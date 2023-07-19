<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestBox extends FormRequest
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
            'title' => 'required',
            'image' => 'required',
            'id_category' => 'required',
            'amount' => 'required',
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Không để trống',
            'image.required' => 'Không để trống',
            'id_category.required' => 'Không để trống',
            'amount.required' => 'Không để trống',
            'price.required' => 'Không để trống',
        ];
    }
}
