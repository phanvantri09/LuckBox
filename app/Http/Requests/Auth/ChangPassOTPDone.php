<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ChangPassOTPDone extends FormRequest
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
           
            'passwordNew' =>  [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~`|[\]\\/"\'])/'
            ],
            'confirm_password' =>  [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~`|[\]\\/"\'])/',
                'same:passwordNew'
            ],
        ];

    }
        public function messages()
    {
        return [
            'passwordNew.required' => 'Vui lòng nhập mật khẩu',
            'passwordNew.min' => 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự',
            'passwordNew.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt',
            'confirm_password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_password.min' => 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự',
            'confirm_password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt',
            'confirm_password.same' => 'Mật khẩu xác nhận phải giống với mật khẩu mới',
        ];
    }
}
