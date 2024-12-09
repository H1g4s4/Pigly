<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;  // 名前空間を修正してモデルをインポート
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightTargetController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'goal_weight' => 'required|numeric|between:0,9999.9',
        ], [
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.numeric' => '4桁までの数字で入力してください',
            'goal_weight.regex' => '小数点は1桁で入力してください',
        ]);

        $user = Auth::user();  // 現在のユーザーを取得

        // ユーザーの目標体重を更新
        $goalWeight = WeightTarget::where('user_id', $user->id)->first();
        if ($goalWeight) {
            $goalWeight->goal_weight = $request->goal_weight;
            $goalWeight->save();
        }

        return redirect()->route('weight-management');  // 体重管理画面にリダイレクト
    }

    public function storeInitialWeight(Request $request)
    {
    // バリデーションルールの修正
    $request->validate([
        'current_weight' => 'required|numeric|between:0,9999.9',  // 小数点1桁までOK
        'goal_weight' => 'required|numeric|between:0,9999.9',  // 小数点1桁までOK
    ], [
        'current_weight.required' => '現在の体重を入力してください',
        'current_weight.numeric' => '現在の体重は数字で入力してください',
        'current_weight.between' => '現在の体重は0〜9999.9の間で入力してください',

        'goal_weight.required' => '目標の体重を入力してください',
        'goal_weight.numeric' => '目標の体重は数字で入力してください',
        'goal_weight.between' => '目標の体重は0〜9999.9の間で入力してください',
    ]);

    // 現在ログイン中のユーザーを取得
    $user = Auth::user();

    // 初期体重データをWeightTargetテーブルに保存
    WeightTarget::create([
        'user_id' => $user->id,
        'current_weight' => $request->current_weight,
        'goal_weight' => $request->goal_weight,  // 目標体重を明示的に渡す
        'target_weight' => $request->goal_weight ?? 0,  // goal_weightがない場合に0を設定
    ]);

    // 体重管理画面にリダイレクト
    return redirect()->route('weight-management');
    }

    public function showGoalWeightForm()
{
    $goalWeight = WeightTarget::where('user_id', Auth::id())->first(); // ログインユーザーの目標体重を取得
    return view('goal-weight-setting', compact('goalWeight')); // 目標体重をビューに渡す
}

}
