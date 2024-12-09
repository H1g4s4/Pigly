<?php
namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    // 更新機能
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|max:9999|min:1',
            'calories' => 'required|numeric',
            'exercise_time' => 'required',
            'exercise_content' => 'nullable|max:120',
        ], [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.max' => '4桁までの数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ]);

        $weightLog = WeightLog::findOrFail($id);
        $weightLog->date = $request->date;
        $weightLog->weight = $request->weight;
        $weightLog->calories = $request->calories;
        $weightLog->exercise_time = $request->exercise_time;
        $weightLog->exercise_content = $request->exercise_content;
        $weightLog->save();

        return redirect()->route('weight-management');  // 体重管理画面へ遷移
    }

    // 削除機能
    public function destroy($id)
    {
        $weightLog = WeightLog::findOrFail($id);
        $weightLog->delete();

        return redirect()->route('weight-management');  // 体重管理画面へ遷移
    }

    public function search(Request $request)
    {
    // バリデーション
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',  // start_date より後の日付
    ]);

    $user = Auth::user();  // 現在のユーザーを取得

    // 指定された期間で体重ログを検索
    $weightLogs = WeightLog::where('user_id', $user->id)
        ->whereBetween('date', [$request->start_date, $request->end_date])
        ->get();

    // 検索結果の件数を取得
    $count = $weightLogs->count();

    // 検索条件をビューに渡す
    return view('weight-management', compact('weightLogs', 'count', 'request->start_date', 'request->end_date'));
    }

    public function create()
    {
    return view('add-weight-log');  // 体重ログ追加フォームを表示
    }

    public function store(Request $request)
    {
    // バリデーション
    $request->validate([
        'date' => 'required|date',
        'weight' => 'required|numeric|max:9999|min:1',
        'calories' => 'required|numeric',
        'exercise_time' => 'required',
        'exercise_content' => 'nullable|max:120',
    ]);

    // 体重ログをデータベースに保存
    WeightLog::create([
        'user_id' => Auth::id(),
        'date' => $request->date,
        'weight' => $request->weight,
        'calories' => $request->calories,
        'exercise_time' => $request->exercise_time,
        'exercise_content' => $request->exercise_content,
    ]);

    return redirect()->route('weight-management');  // 体重管理画面にリダイレクト
    }

    public function storeInitialWeight(Request $request)
    {
    // バリデーション
    $request->validate([
        'current_weight' => 'required|numeric|between:0,9999.9',
        'goal_weight' => 'required|numeric|between:0,9999.9',
    ], [
        'current_weight.required' => '現在の体重を入力してください',
        'goal_weight.required' => '目標の体重を入力してください',
    ]);

    $user = Auth::user();  // 現在ログインしているユーザーを取得

    // 初期体重データをWeightTargetテーブルに保存
    WeightTarget::create([
        'user_id' => $user->id,
        'current_weight' => $request->current_weight,
        'goal_weight' => $request->goal_weight,  // 目標体重を保存
        'target_weight' => $request->goal_weight,  // 目標体重をtarget_weightにも保存
    ]);

    return redirect()->route('weight-management');  // 体重管理画面へリダイレクト
    }


}
