<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnsQuestionManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans_question_manage', function (Blueprint $table) {
            $table->integer('id')->comment("ID");
            $table->integer('type_native_id')->comment("類型固有ID");
            $table->string('member_id', 9)->comment("会員ID");
            $table->integer('registration_year')->comment("単位登録年度");
            $table->tinyInteger('active_flg')->comment("有効・無効フラグ");
            $table->dateTime('update_date')->comment("更新日");
            $table->dateTime('registration_date')->comment("登録日");
            
            $table->primary(['id', 'type_native_id', 'member_id', 'registration_year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ans_question_manage');
    }
}
