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
        Schema::table('his_question_options_settings', function (Blueprint $table) {
            $table->tinyInteger('viewing_check_flg')->default(0)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('his_question_options_settings', function (Blueprint $table) {
            $table->dropColumn('viewing_check_flg');
        });
    }
};
