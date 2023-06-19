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
        Schema::table('answer_info', function(Blueprint $table)
        {
            $table->integer('answer_manage_id')->comment('回答管理ID')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_info', function(Blueprint $table)
        {
            $table->dropColumn('answer_info');
        });
    }
};
