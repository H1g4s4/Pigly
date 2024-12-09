<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('weight_targets', function (Blueprint $table) {
        $table->bigIncrements('id')->unsigned();  // id カラムを bigint unsigned に設定
        $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ユーザーID（外部キー）
        $table->decimal('current_weight', 5, 1);  // 現在の体重（current_weight）
        $table->decimal('goal_weight', 5, 1);  // 目標体重（goal_weight）
        $table->decimal('target_weight', 5, 1);  // target_weight（目標体重のコピー）
        $table->timestamps();  // created_at, updated_at
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_targets');
    }
}
