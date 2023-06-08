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
            $table->integer('id')->primary()->comment("ID");
            $table->string('password', 100)->comment("パスワード");
            $table->string('name', 100)->comment("氏名");
            $table->integer('class')->comment("ユーザー区分");
            $table->tinyInteger('active_flg')->comment("有効・無効フラグ");
            $table->dateTime('registration_date')->comment("登録日");
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
