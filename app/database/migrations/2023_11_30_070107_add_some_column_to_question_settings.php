<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToQuestionSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_settings', function (Blueprint $table) {
            $table->string('description');
            $table->boolean('duplicate_flg');
            $table->boolean('description_flg');
            $table->integer('character_limit');
            $table->integer('interdate_target_id');
            $table->integer('interval_month');
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
            $table->dropColumn('description');
            $table->dropColumn('duplicate_flg');
            $table->dropColumn('description_flg');
            $table->dropColumn('character_limit');
            $table->dropColumn('interdate_target_id');
            $table->dropColumn('interval_month');
        });
    }
};
