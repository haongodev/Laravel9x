<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_settings', function (Blueprint $table) {
            $table->integer('id')->comment("ID");
            $table->char('question_id', 10)->comment("設問ID");
            $table->char('question_display_id', 10)->comment("表示用設問ID");
            $table->integer('type_native_id')->comment("類型固有ID");
            $table->string('title')->comment("名称");
            $table->integer('level')->comment("階層");
            $table->char('parent_question_id', 10)->comment("親階層ID");
            $table->integer('input_method')->comment("入力方式");
            $table->integer('score')->comment("スコア");
            $table->dateTime('update_date')->comment("更新日");
            $table->dateTime('registration_date')->comment("登録日");
            
            $table->primary(['id', 'question_id', 'question_display_id', 'type_native_id', 'parent_question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_settings');
    }
}
