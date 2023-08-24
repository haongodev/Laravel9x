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
        Schema::table('his_question_settings', function (Blueprint $table) {
            $table->tinyInteger('effective_date_flg')->after('score');
            $table->tinyInteger('required_flg')->after('effective_date_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('his_question_settings', function (Blueprint $table) {
            $table->dropColumn('effective_date_flg');
            $table->dropColumn('required_flg');
        });
    }
};
