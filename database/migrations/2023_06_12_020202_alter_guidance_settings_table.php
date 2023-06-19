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
        Schema::table('guidance_settings', function(Blueprint $table)
        {
            $table->char('screen_id',4)->comment("画面ID")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guidance_settings', function(Blueprint $table)
        {
            $table->integer('screen_id')->comment("画面ID")->change();
        });
    }
};
