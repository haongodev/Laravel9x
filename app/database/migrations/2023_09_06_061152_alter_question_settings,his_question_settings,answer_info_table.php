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
        Schema::table('answer_info', function (Blueprint $table) {
            $table->tinyInteger('disp_flg')->default(0)->after('effective_date_flg');
        });
        Schema::table('question_settings', function (Blueprint $table) {
            $table->tinyInteger('disp_flg')->default(0)->after('score');
        });
        Schema::table('his_question_settings', function (Blueprint $table) {
            $table->tinyInteger('disp_flg')->default(0)->after('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_info', function (Blueprint $table) {
            $table->dropColumn('disp_flg');
        });
        Schema::table('question_settings', function (Blueprint $table) {
            $table->dropColumn('disp_flg');
        });
        Schema::table('his_question_settings', function (Blueprint $table) {
            $table->dropColumn('disp_flg');
        });
    }
};
