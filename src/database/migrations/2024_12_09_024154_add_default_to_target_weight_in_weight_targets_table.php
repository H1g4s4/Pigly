<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToTargetWeightInWeightTargetsTable extends Migration
{
    public function up()
    {
        Schema::table('weight_targets', function (Blueprint $table) {
            $table->decimal('target_weight', 5, 1)->default(0)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('weight_targets', function (Blueprint $table) {
            $table->decimal('target_weight', 5, 1)->nullable(false)->change();  // デフォルト値を解除
        });
    }
}

