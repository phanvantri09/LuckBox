<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'card_name' =>'required',
            'card_number' => 'required',
            'bank' => 'required',
            'total' => 'required',
            'code' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'card_name.required' => 'Không được để trống.',
            'card_number.required' => 'Không được để trống.',
            'bank.required' => 'Không được để trống.',
            'total.required' => 'Không được để trống.',
            'code.required' => 'Không được để trống.',
        ];
    }
}
