<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('his_question_settings', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->integer('question_id')->comment('設問ID');
            $table->integer('type_native_id')->comment('類型固有ID');
            $table->string('title',255)->comment('名称');
            $table->integer('level')->comment('階層');
            $table->char('parent_question_id',10)->comment('親階層ID');
            $table->char('parent_question_option_id',10)->comment('親階層選択肢ID');
            $table->integer('input_method')->comment('入力方式');
            $table->integer('score')->comment('終端フラグ');
            $table->boolean('terminal_flg');
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
        Schema::dropIfExists('his_question_settings');
    }
};
