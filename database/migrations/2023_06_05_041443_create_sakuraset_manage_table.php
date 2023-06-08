<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSakurasetManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sakuraset_manage', function (Blueprint $table) {
            $table->integer('id')->comment("ID");
            $table->string('member_id', 9)->comment("会員ID");
            $table->string('reviewer_id', 9)->nullable()->comment("振返り担当者ID");
            $table->integer('reviewer_status')->comment("振返り担当ステータス");
            $table->dateTime('scheduled_date')->comment("次回予定日");
            $table->dateTime('update_date')->comment("更新日");
            $table->dateTime('registration_date')->comment("登録日");
            
            $table->primary(['id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sakuraset_manage');
    }
}
