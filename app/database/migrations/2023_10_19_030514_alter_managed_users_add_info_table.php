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
        Schema::table('managed_users_add_info', function (Blueprint $table) {
            $table->dateTime('delete_date')->nullable();
            $table->dropColumn('delete_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('managed_users_add_info', function (Blueprint $table) {
            $table->tinyInteger('delete_flg')->comment("削除フラグ");
            $table->dropColumn('delete_date');
        });
    }
};
