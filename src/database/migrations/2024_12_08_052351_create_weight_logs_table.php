<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();  // id カラムを bigint unsigned に設定
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ユーザーID（外部キー）
            $table->date('date');  // 日付
            $table->decimal('weight', 4, 1);  // 体重（decimal 型、最大4桁、1桁小数点）
            $table->integer('calories');  // 摂取カロリー（整数型）
            $table->time('exercise_time');  // 運動時間（time 型）
            $table->text('exercise_content')->nullable();  // 運動内容（text 型）
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
        Schema::dropIfExists('weight_logs');
    }
}
