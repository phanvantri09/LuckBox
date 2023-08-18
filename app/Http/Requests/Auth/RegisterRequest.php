<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'email' => [
                'required_without:number_phone',
                'email',
                'nullable',
                Rule::unique('users', 'email')->ignore(null),
                
            ],
            'password' =>  [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~`|[\]\\/"\'])/'
            ],
            'number_phone' =>
            [
                'required_without:email',
                'nullable',
                Rule::unique('users', 'number_phone')->ignore(null),
                'regex:/((\+84|0)[3|5|7|8|9])+([0-9]{8})/' ,
                'digits_between:10,11'
            ],
        ];

    }
        public function messages()
    {
        return [
            // 'email.required' => 'Vui lòng nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Địa chỉ email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt',
            // 'number_phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'number_phone.unique' => 'Số điện thoại này đã được sử dụng',
            'number_phone.digits_between' => 'Số điện thoại phải từ 10 đến 11',
            'number_phone.regex' => 'Không đúng định dạng',
            'email.required_without' => 'Để đăng ký phải điền ít nhất email hoặc số điện thoại.',
            'number_phone.required_without' => 'Để đăng ký phải điền ít nhất email hoặc số điện thoại.',
        ];
    }
}
