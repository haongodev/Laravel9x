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
        Schema::table('initiativetable_manage', function (Blueprint $table) {
            $table->string('member_id', 9)->comment("会員ID");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initiativetable_manage', function (Blueprint $table) {
            $table->dropColumn('member_id');
        });
    }
};
