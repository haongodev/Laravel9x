<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionFilesManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_files_manage', function (Blueprint $table) {
            $table->integer('id')->primary()->comment("ID");
            $table->string('member_id', 9)->comment("会員ID");
            $table->integer('file_type')->comment("ファイル種別");
            $table->string('file_name')->comment("ファイル名");
            $table->string('share_member_id', 9)->comment("共有者ID");
            $table->tinyInteger('agreement_flg')->comment("承認フラグ");
            $table->integer('agreement_user_id')->comment("承認者");
            $table->dateTime('agreement_date')->comment("承認日");
            $table->dateTime('delete_date')->comment("削除日");
            $table->dateTime('update_date')->comment("更新日");
            $table->dateTime('registration_date')->comment("登録日");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_files_manage');
    }
}
