<?php
// app/Http/Controllers/WeightManagementController.php
namespace App\Http\Controllers;

use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WeightManagementController extends Controller
{
    // WeightManagementController.php

    public function show(Request $request)
    {
    if (!Auth::check()) {
        return redirect()->route('register');
    }

    $user = Auth::user();  // 現在ログイン中のユーザーを取得

    // ユーザーの目標体重を取得
    $goalWeight = WeightTarget::where('user_id', $user->id)->first();

    // ユーザーの最新体重を取得
    $latestWeight = WeightLog::where('user_id', $user->id)
        ->orderBy('date', 'desc')  // 'date'で降順に並べ替えて最新体重を取得
        ->value('weight');

    // ユーザーの体重記録を取得し、ページネーションを適用
    $weightLogs = WeightLog::where('user_id', $user->id)->paginate(8); // ここで weightLogs を取得

    // 目標体重が設定されていない場合、0を代入
    if (!$goalWeight) {
        $goalWeight = new \stdClass();
        $goalWeight->goal_weight = 0;
    }

    // 最新体重がない場合、0を代入
    if (!$latestWeight) {
        $latestWeight = 0;
    }

    // 検索フォームのstart_dateとend_dateをビューに渡す
    $start_date = $request->start_date ?? '';
    $end_date = $request->end_date ?? '';

    // $countをweightLogsの件数として計算
    $count = $weightLogs->count();

    // ビューにデータを渡す
    return view('weight-management', compact('goalWeight', 'latestWeight', 'weightLogs', 'start_date', 'end_date', 'count'));
    }


    public function showInitialWeightForm()
    {
        return view('initial-weight');
    }

    public function storeInitialWeight(Request $request)
    {
        $request->validate([
            'current_weight' => 'required|numeric|between:0,9999.9',
            'goal_weight' => 'required|numeric|between:0,9999.9',
        ], [
            'current_weight.required' => '現在の体重を入力してください',
            'current_weight.digits_between' => '4桁までの数字で入力してください',
            'current_weight.regex' => '小数点は1桁で入力してください',
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.digits_between' => '4桁までの数字で入力してください',
            'goal_weight.regex' => '小数点は1桁で入力してください',
        ]);

        // 現在ログイン中のユーザーを取得
        $user = Auth::user();

        // 初期体重データをWeightTargetテーブルに保存
        WeightTarget::create([
            'user_id' => $user->id,
            'current_weight' => $request->current_weight,
            'goal_weight' => $request->goal_weight,
            'target_weight' => $request->goal_weight,
        ]);

        // 体重管理画面にリダイレクト
        return redirect()->route('weight-management');
    }
}
