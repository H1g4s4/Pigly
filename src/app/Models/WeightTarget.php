<?php

namespace App\Models;  // 名前空間を修正

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','current_weight','goal_weight',
        'target_weight',
    ];

    // 関連付けを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
