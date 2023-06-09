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
        Schema::rename('ans_question_settings','answer_info');
        Schema::table('answer_info', function(Blueprint $table)
        {
            $table->dropColumn('question_id');
            $table->dropColumn('parent_question_id');
            $table->integer('original_question_id')->comment('オリジナル設問ID')->after('id');
            $table->boolean('terminal_flg')->comment('終端フラグ')->after('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('answer_info','ans_question_settings');
        Schema::table('ans_question_settings', function(Blueprint $table)
        {
            $table->char('question_id', 10)->comment("設問ID");
            $table->char('parent_question_id', 10)->comment("親階層ID");
            $table->dropColumn('original_question_id');
            $table->dropColumn('terminal_flg');
        });
    }
};
