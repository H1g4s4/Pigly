<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();  // id カラム
            $table->string('name');  // name カラム
            $table->string('email')->unique();  // email カラム
            $table->timestamp('email_verified_at')->nullable();  // email_verified_at カラムを追加
            $table->string('password');  // password カラム
            $table->rememberToken();  // remember_token
            $table->timestamps();  // created_at, updated_at カラム
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
