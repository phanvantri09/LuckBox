<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequestUser extends FormRequest
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
            'email' => 'required|unique:users',
            'password' =>  [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~`|[\]\\/"\'])/'
            ],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Không để trống',
            'email.unique' => 'Đã tồn tại',
            'password.required' => 'Không để trống',
            'password.min' => 'Phải nhiều hơn 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt'
        ];
    }
}
