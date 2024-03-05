<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'newCate' => 'required|string|max:255|unique:category,name',
        ];
    }

    public function messages()
    {
        return  [
            'unique' => 'Tên hãng bị trùng',
            'max'=>'Tên hãng quá dài',
            'required' => 'Thiếu mã hãng',
            'exists' => 'Mã hàng không tồn tại'
        ];
    }
}
