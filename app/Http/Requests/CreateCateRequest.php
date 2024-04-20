<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCateRequest extends FormRequest
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
            'cate' => 'required|string|max:255|unique:category,name'
        ];



    }
    public function messages()
    {
        return [
            'cate.required' => 'Thiếu tên hãng xe',
            'max' => 'Tên hãng quá dài',
            'unique' => 'Tên hãng xe bị trùng'
        ];
    }
}
