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
            $table->uuid('id')->change();
            $table->uuid('users_id')->change();
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
            $table->integer('id')->change();
            $table->integer('users_id')->change();
        });
    }
};
