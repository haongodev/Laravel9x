<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagedUsersAddInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managed_users_add_info', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
            $table->integer('users_id')->comment("ユーザーID");
            $table->integer('manager_class')->comment("管理者区分");
            $table->integer('attribute')->comment("属性");
            $table->tinyInteger('delete_flg')->comment("削除フラグ");
            $table->dateTime('update_date')->comment("更新日");
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
        Schema::dropIfExists('managed_users_add_info');
    }
}
