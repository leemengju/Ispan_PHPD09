<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;

class MyFormRequest extends FormRequest
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
            'uid' => 'required|min:3|max:5|unique:userinfo,uid', //最少要三個字//unique:不可以用現有帳號資訊。
            'password' => [
                'required',
                'confirmed',
                Password::min(4)
                    ->mixedCase()  // 大小寫混合
                    ->letters()  // 要有一個文字
                    ->numbers()  // 要有一個數字
                    ->symbols()  // 要有一個符號

            ] //密碼需要被驗證
        ];
    }

    // 自定義錯誤資訊:如果違反規則，會跳出自定義錯誤信息
    function messages()
    {

        return [
            'uid.max' => "帳號長度超過:max個字數",
            'password.confirmed' => "密碼不一致"
        ];
    }
}
