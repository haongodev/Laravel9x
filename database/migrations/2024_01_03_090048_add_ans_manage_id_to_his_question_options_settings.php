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
            $table->integer('ans_manage_id');
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
            $table->dropColumn('ans_manage_id');
        });
    }
};
