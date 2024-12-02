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
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->dropPrimary();
        });
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->id()->before('file_name')->first();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->dropPrimary();
        });
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('reflectionsheet_manage', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
        });
    }
};
