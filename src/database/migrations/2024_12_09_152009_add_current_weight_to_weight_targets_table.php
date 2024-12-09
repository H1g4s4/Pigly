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
            $table->decimal('current_weight', 5, 1)->nullable();  // current_weightカラムを追加
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
            $table->dropColumn('current_weight');  // current_weightカラムを削除
        });
    }
}
