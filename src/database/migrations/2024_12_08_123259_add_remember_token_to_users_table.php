<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // remember_token カラムが存在しない場合のみ追加
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->rememberToken();  // remember_token カラムを追加
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
        Schema::table('users', function (Blueprint $table) {
            // remember_token カラムが存在する場合のみ削除
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');  // remember_token カラムを削除
            }
        });
    }
}
