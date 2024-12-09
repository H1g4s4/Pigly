<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date' => 'required|date',
            'weight' => 'required|numeric|max:9999|min:1',
            'calories' => 'required|numeric',
            'exercise_time' => 'required',
            'exercise_content' => 'nullable|max:120',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
