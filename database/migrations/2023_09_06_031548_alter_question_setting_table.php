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
        Schema::table('question_settings', function (Blueprint $table) {
            $table->tinyInteger('viewing_check_flg')->default(0)->after('terminal_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_settings', function (Blueprint $table) {
            $table->dropColumn('viewing_check_flg');
        });
    }
};
