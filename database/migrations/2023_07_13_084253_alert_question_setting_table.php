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
        Schema::table('question_settings', function(Blueprint $table)
        {
            $table->dropPrimary();
            $table->tinyInteger('terminal_flg')->after('score');
            $table->dropColumn('question_display_id');
            $table->primary(['id', 'question_id', 'type_native_id', 'parent_question_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_settings', function(Blueprint $table)
        {
            $table->dropColumn('terminal_flg');
            $table->integer('question_display_id')->after('question_id');
            $table->primary(['id', 'question_id', 'question_display_id', 'type_native_id', 'parent_question_id']);
        });
    }
};
