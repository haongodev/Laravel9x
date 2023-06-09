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
        Schema::rename('ans_question_manage','answer_manage');
        Schema::table('answer_manage', function(Blueprint $table)
        {
            $table->renameColumn('type_native_id', 'question_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('answer_manage','ans_question_manage');
        Schema::table('answer_manage', function(Blueprint $table)
        {
            $table->renameColumn('question_id', 'type_native_id');
        });

    }
};
