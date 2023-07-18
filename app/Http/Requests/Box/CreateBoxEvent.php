<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class CreateBoxEvent extends FormRequest
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
            'link_image' =>'required|mimes:jpg,png|max:5120',
            'title' => 'required',
            'description' => 'required',
            'time_start' => 'required',
            'time_end' => 'required'
        ];
    }
    public function messages(){
        return [
            'link_image.required' => 'Không được để trống',
            'link_image.mimes' => 'Định dạng ảnh phải là JPG, PNG' ,
            'link_image.max' => 'Vui lòng chọn ảnh có dung lượng < 5 MB',

            'title.required' => ' Không được để trống',
            'description.required' => ' Không được để trống',
            'time_start.required' => ' Không được để trống',
            'time_end.required' => ' Không được để trống'
        ];
    }
}
