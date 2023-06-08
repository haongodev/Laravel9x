<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnsQuestionOptionsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans_question_options_settings', function (Blueprint $table) {
            $table->integer('id')->comment("ID");
            $table->integer('question_id')->comment("設問ID");
            $table->integer('type_native_id')->comment("類型固有ID");
            $table->string('class_name')->nullable()->comment("区分名称");
            $table->string('option_name')->comment("選択肢名称");
            $table->tinyInteger('checked')->nullable()->comment("選択状況");
            $table->integer('score')->nullable()->comment("取得単位");
            $table->integer('sort_order')->comment("並び順");
            $table->dateTime('update_date')->comment("更新日");
            $table->dateTime('registration_date')->comment("登録日");
            
            $table->primary(['id', 'type_native_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ans_question_options_settings');
    }
}
