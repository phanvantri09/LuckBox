<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
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
            'email.required' => 'Vui lòng nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Địa chỉ email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt'
        ];
    }
}
