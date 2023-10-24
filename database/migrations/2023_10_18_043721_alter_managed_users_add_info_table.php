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
        Schema::table('managed_users_add_info', function (Blueprint $table) {
            $table->string('login_id', 10)->comment("ログインID")->after('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('managed_users_add_info', function (Blueprint $table) {
            $table->dropColumn('login_id');
        });
    }
};
