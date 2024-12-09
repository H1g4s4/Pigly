<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // ログインページを表示
    }

    public function login(LoginRequest $request)
    {
        // バリデーション後、ログイン処理を実行
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('weight-management');  // 体重管理画面に遷移
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています',
        ]);
    }
}

