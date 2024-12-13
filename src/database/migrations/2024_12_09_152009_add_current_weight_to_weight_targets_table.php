<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentWeightToWeightTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_targets', function (Blueprint $table) {
            // current_weight カラムが既に存在しない場合のみ追加
            if (!Schema::hasColumn('weight_targets', 'current_weight')) {
                $table->decimal('current_weight', 5, 1)->nullable();  // current_weight カラムを追加
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
            // current_weight カラムが存在する場合のみ削除
            if (Schema::hasColumn('weight_targets', 'current_weight')) {
                $table->dropColumn('current_weight');  // current_weight カラムを削除
            }
        });
    }
}
