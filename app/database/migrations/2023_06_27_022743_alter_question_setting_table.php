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
            $table->integer('parent_question_option_id')->after('parent_question_id');
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
            $table->dropColumn('question_settings_id');
        });
    }
};
