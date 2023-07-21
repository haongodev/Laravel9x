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
        Schema::table('answer_manage', function(Blueprint $table)
        {
            $table->integer('type_native_id')->after('question_id');
            $table->dropColumn('active_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_manage', function(Blueprint $table)
        {
            $table->dropColumn('type_native_id');
            $table->tinyInteger('active_flg')->comment("有効・無効フラグ");
        });
    }
};
