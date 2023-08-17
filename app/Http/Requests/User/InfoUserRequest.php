<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InfoUserRequest extends FormRequest
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
            // 'link_image' =>'required|mimes:jpg,png|max:5120'
            'link_image' =>'mimes:jpg,png|max:5120',
            'number_phone' =>
            [
                'required',
                'regex:/((\+84|0)[3|5|7|8|9])+([0-9]{8})/' ,
                'digits_between:10,11'
            ],
        ];
    }

    public function messages(){
        return [
            // 'link_image.required' => 'Không được để trống',
            'link_image.mimes' => 'Định dạng ảnh phải là JPG, PNG' ,
            'link_image.max' => 'Vui lòng chọn ảnh có dung lượng < 5 MB',
            'number_phone.required' => 'Vui lòng nhập số điện thoại của bạn',
            'number_phone.digits_between' => 'Số điện thoại phải từ 10 đến 11',
            'number_phone.regex' => 'Không đúng định dạng',
        ];
    }
}
