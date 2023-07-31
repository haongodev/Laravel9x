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
        Schema::table('facesheet_manage', function (Blueprint $table) {
            $table->string('display_name')->nullable()->comment("display_file_name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facesheet_manage', function (Blueprint $table) {
            $table->dropColumn('display_name');
        });
    }
};
