<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoalWeightToWeightTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_targets', function (Blueprint $table) {
            $table->decimal('goal_weight', 5, 1);  // goal_weightカラムを追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_targets', function (Blueprint $table) {
            $table->dropColumn('goal_weight');  // goal_weightカラムを削除
        });
    }
}
