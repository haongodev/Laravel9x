<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateTrainingManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_training_manage', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
            $table->integer('target_year')->comment("対象年度");
            $table->integer('training_type')->comment("研修種別");
            $table->string('title')->comment("タイトル");
            $table->dateTime('effective_date')->comment("開催日");
            $table->dateTime('start_date')->comment("受付開始日");
            $table->dateTime('closing_date')->comment("受付終了日");
            $table->tinyInteger('active_flg')->comment("有効・無効フラグ");
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
        Schema::dropIfExists('update_training_manage');
    }
}
