<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255'
        ];



    }
    public function messages()
    {
        return [

            'name.required' => 'Thiếu tên người dùng',
            'email.required' => 'Chưa nhập email người dùng',
            'password.required' => 'Chưa nhập mật khẩu',
            'name.max' => 'Tên quá dài',
            'email.max' => 'Email quá quá dài',
            'email.unique' => 'Email đã tồn tại'
        ];
    }
}
