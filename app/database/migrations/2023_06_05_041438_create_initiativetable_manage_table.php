<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitiativetableManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initiativetable_manage', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
            $table->string('file_name')->comment("ファイル名");
            $table->integer('share_flg')->comment("共有フラグ");
            $table->dateTime('delete_date')->comment("削除日");
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
        Schema::dropIfExists('initiativetable_manage');
    }
}
