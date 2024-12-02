<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guidance_settings', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
            $table->integer('screen_id')->comment("画面ID");
            $table->integer('location_id')->comment("位置ID");
            $table->integer('sentence_class')->comment("文章区分");
            $table->text('guidance')->comment("表示文章");
            $table->boolean('active_flg')->default(0)->comment("有効・無効フラグ");
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
        Schema::dropIfExists('guidance_settings');
    }
}
