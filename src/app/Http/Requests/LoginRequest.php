<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // バリデーションを許可する
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',  // メールアドレスが必須で、ユーザーのものと一致
            'password' => 'required|string',  // パスワードが必須
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.exists' => '登録されていないメールアドレスです',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}

