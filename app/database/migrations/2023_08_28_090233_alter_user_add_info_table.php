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
        Schema::table('users_add_info', function (Blueprint $table) {
//            $table->dropColumn('prefectural_associatio_16');
//            $table->dropColumn('prefectural_associatio_17');
//            $table->dropColumn('prefectural_associatio_18');
//            $table->dropColumn('prefectural_associatio_19');
//            $table->dropColumn('prefectural_associatio_20');
//            $table->dropColumn('prefectural_associatio_21');
//            $table->dropColumn('prefectural_associatio_22');
//            $table->dropColumn('prefectural_associatio_23');
//            $table->dropColumn('prefectural_associatio_24');
//            $table->dropColumn('prefectural_associatio_25');
//            $table->dropColumn('prefectural_associatio_26');
//            $table->dropColumn('prefectural_associatio_27');
//            $table->dropColumn('prefectural_associatio_28');
//            $table->dropColumn('prefectural_associatio_29');
//            $table->dropColumn('prefectural_associatio_30');
//            $table->dropColumn('prefectural_associatio_31');
//            $table->dropColumn('prefectural_associatio_32');
//            $table->dropColumn('prefectural_associatio_33');
//            $table->dropColumn('prefectural_associatio_34');
//            $table->dropColumn('prefectural_associatio_35');
//            $table->dropColumn('prefectural_associatio_36');
//            $table->dropColumn('prefectural_associatio_37');
//            $table->dropColumn('prefectural_associatio_38');
//            $table->dropColumn('prefectural_associatio_39');
//            $table->dropColumn('prefectural_associatio_40');
//            $table->dropColumn('prefectural_associatio_41');
//            $table->dropColumn('prefectural_associatio_42');
//            $table->dropColumn('prefectural_associatio_43');
//            $table->dropColumn('prefectural_associatio_44');
//            $table->dropColumn('prefectural_associatio_45');
//            $table->dropColumn('prefectural_associatio_46');
//            $table->dropColumn('prefectural_associatio_47');
//            $table->dropColumn('purchase_of_training_textbooks_1');
//            $table->dropColumn('purchase_of_training_textbooks_2');
//            $table->dropColumn('purchase_of_training_textbooks_3');
//            $table->dropColumn('reason');
//            $table->dropColumn('training_individual_form');
//            $table->dropColumn('authorized_individual_form');
//            $table->dropColumn('office_management_memo_1');
//            $table->dropColumn('office_management_memo_2');
//            $table->dropColumn('office_management_memo_3');
//            $table->dropColumn('office_management_memo_4');
//            $table->dropColumn('office_management_memo_5');
//            $table->dropColumn('office_management_memo_6');
//            $table->dropColumn('office_management_memo_7');
//            $table->dropColumn('office_management_memo_8');
//            $table->dropColumn('office_management_memo_9');
//            $table->dropColumn('withdrawal_date');
//            $table->dropColumn('branch_general_meeting');
//            $table->dropColumn('free_text_1');
//            $table->dropColumn('free_text_2');
//            $table->dropColumn('free_text_3');
//            $table->dropColumn('clover_individual_important_contact_column');
//            $table->dropColumn('continuing_training_attendance_cycle');
//            $table->dropColumn('group_training_participation');
//            $table->dropColumn('need_attend_group_training_within_cycle');
//            $table->dropColumn('how_pay_registration_fee');
//            $table->dropColumn('clover_registration_fee_paid');
//            $table->dropColumn('partner_registration');
//            $table->dropColumn('intention_accept_appointment');
//            $table->dropColumn('clover_home_email');
//            $table->dropColumn('home_mailing_list_registration');
//            $table->dropColumn('clover_affiliated_address');
//            $table->dropColumn('clover_affiliated_mail_status');
//            $table->dropColumn('clover_mailing_list_registration');
//            $table->dropColumn('clover_mail_etc');
//            $table->dropColumn('etc_mailing_list_registration');
//            $table->dropColumn('clover_family_1');
//            $table->dropColumn('clover_family_2');
//            $table->dropColumn('clover_family_3');
//            $table->dropColumn('clover_family_4');
//            $table->dropColumn('clover_family_5');
//            $table->dropColumn('clover_family_6');
//            $table->dropColumn('clover_family_7');
//            $table->dropColumn('clover_family_8');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_add_info', function (Blueprint $table) {
//            $table->string('prefectural_associatio_16', 2)->nullable()->comment("入会している都道府県協会-富山県");
//            $table->string('prefectural_associatio_17', 2)->nullable()->comment("入会している都道府県協会-石川県");
//            $table->string('prefectural_associatio_18', 2)->nullable()->comment("入会している都道府県協会-福井県");
//            $table->string('prefectural_associatio_19', 2)->nullable()->comment("入会している都道府県協会-山梨県");
//            $table->string('prefectural_associatio_20', 2)->nullable()->comment("入会している都道府県協会-長野県");
//            $table->string('prefectural_associatio_21', 2)->nullable()->comment("入会している都道府県協会-岐阜県");
//            $table->string('prefectural_associatio_22', 2)->nullable()->comment("入会している都道府県協会-静岡県");
//            $table->string('prefectural_associatio_23', 2)->nullable()->comment("入会している都道府県協会-愛知県");
//            $table->string('prefectural_associatio_24', 2)->nullable()->comment("入会している都道府県協会-三重県");
//            $table->string('prefectural_associatio_25', 2)->nullable()->comment("入会している都道府県協会-滋賀県");
//            $table->string('prefectural_associatio_26', 2)->nullable()->comment("入会している都道府県協会-京都府");
//            $table->string('prefectural_associatio_27', 2)->nullable()->comment("入会している都道府県協会-大阪府");
//            $table->string('prefectural_associatio_28', 2)->nullable()->comment("入会している都道府県協会-兵庫県");
//            $table->string('prefectural_associatio_29', 2)->nullable()->comment("入会している都道府県協会-奈良県");
//            $table->string('prefectural_associatio_30', 2)->nullable()->comment("入会している都道府県協会-和歌山県");
//            $table->string('prefectural_associatio_31', 2)->nullable()->comment("入会している都道府県協会-鳥取県");
//            $table->string('prefectural_associatio_32', 2)->nullable()->comment("入会している都道府県協会-島根県");
//            $table->string('prefectural_associatio_33', 2)->nullable()->comment("入会している都道府県協会-岡山県");
//            $table->string('prefectural_associatio_34', 2)->nullable()->comment("入会している都道府県協会-広島県");
//            $table->string('prefectural_associatio_35', 2)->nullable()->comment("入会している都道府県協会-山口県");
//            $table->string('prefectural_associatio_36', 2)->nullable()->comment("入会している都道府県協会-徳島県");
//            $table->string('prefectural_associatio_37', 2)->nullable()->comment("入会している都道府県協会-香川県");
//            $table->string('prefectural_associatio_38', 2)->nullable()->comment("入会している都道府県協会-愛媛県");
//            $table->string('prefectural_associatio_39', 2)->nullable()->comment("入会している都道府県協会-高知県");
//            $table->string('prefectural_associatio_40', 2)->nullable()->comment("入会している都道府県協会-福岡県");
//            $table->string('prefectural_associatio_41', 2)->nullable()->comment("入会している都道府県協会-佐賀県");
//            $table->string('prefectural_associatio_42', 2)->nullable()->comment("入会している都道府県協会-長崎県");
//            $table->string('prefectural_associatio_43', 2)->nullable()->comment("入会している都道府県協会-熊本県");
//            $table->string('prefectural_associatio_44', 2)->nullable()->comment("入会している都道府県協会-大分県");
//            $table->string('prefectural_associatio_45', 2)->nullable()->comment("入会している都道府県協会-宮崎県");
//            $table->string('prefectural_associatio_46', 2)->nullable()->comment("入会している都道府県協会-鹿児島県");
//            $table->string('prefectural_associatio_47', 2)->nullable()->comment("入会している都道府県協会-沖縄県");
//            $table->string('purchase_of_training_textbooks_1', 100)->nullable()->comment("研修テキスト購入状況-共通テキスト第１版");
//            $table->string('purchase_of_training_textbooks_2', 100)->nullable()->comment("研修テキスト購入状況-共通テキスト第２版");
//            $table->string('purchase_of_training_textbooks_3', 100)->nullable()->comment("研修テキスト購入状況-共通テキスト改訂第２版");
//            $table->text('reason')->nullable()->comment("テキスト所持理由");
//            $table->string('training_individual_form', 100)->nullable()->comment("研修個人票");
//            $table->string('authorized_individual_form', 100)->nullable()->comment("認定個人票");
//            $table->text('office_management_memo_1')->nullable()->comment("事務管理メモ-★★倫理委員会関連注意あり★★");
//            $table->text('office_management_memo_2')->nullable()->comment("事務管理メモ-合格証入会（登録証未確認）");
//            $table->text('office_management_memo_3')->nullable()->comment("事務管理メモ-便宜的職場なし");
//            $table->text('office_management_memo_4')->nullable()->comment("事務管理メモ-（旧）領収書希望（氏名のみ）");
//            $table->text('office_management_memo_5')->nullable()->comment("事務管理メモ-（旧）領収書希望（勤務先機関＋氏名）");
//            $table->text('office_management_memo_6')->nullable()->comment("事務管理メモ-（旧）領収書：職場とりまとめ希望あり");
//            $table->text('office_management_memo_7')->nullable()->comment("事務管理メモ-（旧）その他希望あり");
//            $table->text('office_management_memo_8')->nullable()->comment("事務管理メモ-【重要】翌々年度まで前受会費あり");
//            $table->text('office_management_memo_9')->nullable()->comment("事務管理メモ-【重要】入会時送金が分割となっている");
//            $table->string('withdrawal_date', 10)->nullable()->comment("退会処理日");
//            $table->string('branch_general_meeting', 100)->nullable()->comment("2023年度支部総会");
//            $table->text('free_text_1')->nullable()->comment("自由文字１");
//            $table->text('free_text_2')->nullable()->comment("自由文字２");
//            $table->text('free_text_3')->nullable()->comment("自由数値３");
//            $table->text('clover_individual_important_contact_column')->nullable()->comment("クローバー個別重要連絡欄");
//            $table->string('continuing_training_attendance_cycle', 100)->nullable()->comment("継続研修受講サイクル");
//            $table->string('group_training_participation', 100)->nullable()->comment("集合研修受講状況");
//            $table->string('need_attend_group_training_within_cycle', 100)->nullable()->comment("周期内の集合研修受講の必要性");
//            $table->string('how_pay_registration_fee', 100)->nullable()->comment("登録費の納入方法");
//            $table->string('clover_registration_fee_paid', 100)->nullable()->comment("2023年度クローバー登録費納入状況");
//            $table->string('partner_registration', 100)->nullable()->comment("ぱあとなあ登録");
//            $table->string('intention_accept_appointment', 100)->nullable()->comment("受任の意思");
//            $table->string('clover_home_email', 100)->nullable()->comment("クローバー　自宅メールアドレス");
//            $table->string('home_mailing_list_registration', 100)->nullable()->comment("自宅アドレス　メーリングリスト登録");
//            $table->string('clover_affiliated_address', 100)->nullable()->comment("クローバー　所属アドレス");
//            $table->string('clover_affiliated_mail_status', 100)->nullable()->comment("クローバー所属メール状況");
//            $table->string('clover_mailing_list_registration', 100)->nullable()->comment("所属アドレス　メーリングリスト登録");
//            $table->string('clover_mail_etc', 100)->nullable()->comment("クローバー　メールその他");
//            $table->string('etc_mailing_list_registration', 100)->nullable()->comment("その他アドレス　メーリングリスト登録");
//            $table->string('clover_family_1', 100)->nullable()->comment("クローバー登録希望家裁1");
//            $table->string('clover_family_2', 100)->nullable()->comment("クローバー登録希望家裁2");
//            $table->string('clover_family_3', 100)->nullable()->comment("クローバー登録希望家裁3");
//            $table->string('clover_family_4', 100)->nullable()->comment("クローバー登録希望家裁4");
//            $table->string('clover_family_5', 100)->nullable()->comment("クローバー登録希望家裁5");
//            $table->string('clover_family_6', 100)->nullable()->comment("クローバー登録希望家裁6");
//            $table->string('clover_family_7', 100)->nullable()->comment("クローバー登録希望家裁7");
//            $table->string('clover_family_8', 100)->nullable()->comment("クローバー登録希望家裁8");
        });
    }
};
