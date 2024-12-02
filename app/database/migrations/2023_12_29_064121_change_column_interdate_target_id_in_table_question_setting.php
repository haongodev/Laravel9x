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
        Schema::table('question_settings', function (Blueprint $table) {
            $table->renameColumn('interdate_target_id', 'interval_target_id');
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
            $table->renameColumn('interval_target_id', 'interdate_target_id');
        });
    }
};
