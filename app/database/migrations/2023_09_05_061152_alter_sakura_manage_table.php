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
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->dropPrimary();
        });
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->id()->before('users_id')->first();
            $table->dateTime('scheduled_date')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->dropPrimary();
        });
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        Schema::table('sakuraset_manage', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
        });
    }
};
