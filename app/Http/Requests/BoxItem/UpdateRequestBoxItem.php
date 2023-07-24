<?php

namespace App\Http\Requests\BoxItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestBoxItem extends FormRequest
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
            'id_box' => 'required',
            'amount' => 'required',
            'time_start' => 'required',
            'time_end' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'products.required' => 'Không để trống',
            'amount.required' => 'Không để trống',
            'time_start.required' => 'Không để trống',
            'time_end.required' => 'Không để trống',
        ];
    }
}
