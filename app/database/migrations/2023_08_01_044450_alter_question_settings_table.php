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
            $table->primary(['id', 'question_id', 'type_native_id']);
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
            $table->dropPrimary();
            $table->primary(['id', 'question_id', 'type_native_id', 'parent_question_id']);
        });
    }
};
