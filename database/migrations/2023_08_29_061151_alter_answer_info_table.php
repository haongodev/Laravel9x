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
            $table->dropColumn('effective_date_flg');
            $table->tinyInteger('viewing_check_flg')->default(0);
        });
        Schema::table('answer_info', function (Blueprint $table) {
            $table->tinyInteger('effective_date_flg')->default(0);
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
            $table->dateTime('effective_date_flg')->nullable()->default(null)->change();
            $table->dropColumn('viewing_check_flg');
        });
    }
};
