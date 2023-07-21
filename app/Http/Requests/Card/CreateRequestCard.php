<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestCard extends FormRequest
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
            'card_branch' => 'required',
            'card_number' => 'required',
            'bank' => 'required',
            'status' => 'required'
        ];
    }
    public function messages(){
        return [
            'card_name.required' => 'Không được để trống',
            'card_branch.required' => ' Không được để trống',
            'card_number.required' => ' Không được để trống',
            'bank.required' => ' Không được để trống',
            'status.required' => ' Không được để trống'
        ];
    }
}
