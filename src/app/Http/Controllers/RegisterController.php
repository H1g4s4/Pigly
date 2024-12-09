<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        // ユーザー情報の登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードのハッシュ化
        ]);

        // ログイン処理
        Auth::login($user);

        // 初期体重登録画面へリダイレクト
        return redirect()->route('initial-weight');
    }
}
