<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class WeightLogFactory extends Factory
{
    // モデルに関連付けられたファクトリ
    protected $model = WeightLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // ユーザーの ID（User ファクトリを使って作成）
            'date' => $this->faker->date(), // ランダムな日付
            'weight' => $this->faker->randomFloat(1, 40, 100), // ランダムな体重（40kg〜100kg）
            'calories' => $this->faker->numberBetween(1000, 3000), // 摂取カロリー（1000〜3000cal）
            'exercise_time' => $this->faker->time('H:i'), // ランダムな運動時間（時間:分）
            'exercise_content' => $this->faker->sentence(), // 運動内容（ランダムな文章）
        ];
    }
}
