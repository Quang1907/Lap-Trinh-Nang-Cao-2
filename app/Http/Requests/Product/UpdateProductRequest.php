<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'required',
            'image_list' => 'required',
            'desc' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là chữ số',
            'image.required' => 'Vui lòng tải lên hình ảnh đại diện',
            'image_list.required' => 'Vui lòng tải lên hình ảnh chi tiết',
            'desc.required' => 'Vui lòng viết mô tả của sản phẩm',
        ];
    }
}
