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
            // goal_weight カラムが既に存在しない場合のみ追加
            if (!Schema::hasColumn('weight_targets', 'goal_weight')) {
                $table->decimal('goal_weight', 5, 1);  // goal_weight カラムを追加
            }
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
            // goal_weight カラムが存在する場合のみ削除
            if (Schema::hasColumn('weight_targets', 'goal_weight')) {
                $table->dropColumn('goal_weight');  // goal_weight カラムを削除
            }
        });
    }
}
