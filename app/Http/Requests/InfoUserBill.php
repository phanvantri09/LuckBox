<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoUserBill extends FormRequest
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
            'name' => 'required',
            'address' => 'required|min:15',
            'number_phone' =>
            [
                'required',
                'regex:/((\+84|0)[3|5|7|8|9])+([0-9]{8})/' ,
                'digits_between:10,11'
            ],
        ];

    }
        public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập',
            'address.required' => 'Vui lòng nhập',
            'address.min' => 'Địa chỉ này chưa được cụ thể bạn có thể điền thêm thông tin!',
            'number_phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'number_phone.unique' => 'Số điện thoại này đã được sử dụng',
            'number_phone.digits_between' => 'Số điện thoại phải từ 10 đến 11',
            'number_phone.regex' => 'Không đúng định dạng',
        ];
    }
}
