<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_manage', function (Blueprint $table) {
            $table->integer('id')->comment("ID");
            $table->integer('type_native_id')->comment("類型固有ID");
            $table->string('type_name', 50)->comment("類型名称");
            $table->tinyInteger('no_edit_flg')->comment("編集無効フラグ");
            $table->tinyInteger('active_flg')->comment("有効・無効フラグ");
            $table->dateTime('delete_date')->nullable()->comment("削除日");
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
        Schema::dropIfExists('type_manage');
    }
}
