<?php
namespace App\Http\Controllers;

use App\Http\Requests\InitialWeightRequest;  // フォームリクエストをインポート
use App\Models\User;  // User モデルをインポート（もし体重情報をUserに関連付ける場合）

class InitialWeightController extends Controller
{
    public function store(InitialWeightRequest $request)
    {
        // バリデーション後、データを取得
        $data = $request->validated();

        // ユーザーの体重情報をデータベースに保存
        $user = auth()->user();  // ログイン中のユーザーを取得
        $user->current_weight = $data['current_weight'];
        $user->goal_weight = $data['goal_weight'];
        $user->save();  // データベースに保存

        // 体重管理画面へリダイレクト
        return redirect()->route('weight-management');
    }
}
