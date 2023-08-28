<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_add_info', function (Blueprint $table) {
//            $table->dropColumn('delivery_suspension');
//            $table->dropColumn('status');
//            $table->dropColumn('remarks');
//            $table->dropColumn('family_register');
//            $table->dropColumn('mental_health_worker_registration_number');
//            $table->dropColumn('birth_date');
//            $table->dropColumn('sex');
//            $table->dropColumn('sex_remarks');
//            $table->dropColumn('membership_fee');
//            $table->dropColumn('account_transfer_registration_status');
//            $table->dropColumn('next_scheduled_account_transfer_date');
//            $table->dropColumn('send_materials_to');
//            $table->dropColumn('information_at_the_time_of_mailing');
//            $table->dropColumn('role_1');
//            $table->dropColumn('role_2');
//            $table->dropColumn('role_3');
//            $table->dropColumn('role_4');
//            $table->dropColumn('role_5');
//            $table->dropColumn('role_6');
//            $table->dropColumn('role_7');
//            $table->dropColumn('role_8');
//            $table->dropColumn('role_9');
//            $table->dropColumn('role_10');
//            $table->dropColumn('role_11');
//            $table->dropColumn('role_12');
//            $table->dropColumn('role_13');
//            $table->dropColumn('role_14');
//            $table->dropColumn('role_15');
//            $table->dropColumn('role_16');
//            $table->dropColumn('role_17');
//            $table->dropColumn('role_18');
//            $table->dropColumn('role_19');
//            $table->dropColumn('role_20');
//            $table->dropColumn('role_21');
//            $table->dropColumn('role_22');
//            $table->dropColumn('role_23');
//            $table->dropColumn('role_24');
//            $table->dropColumn('role_25');
//            $table->dropColumn('role_26');
//            $table->dropColumn('role_27');
//            $table->dropColumn('role_28');
//            $table->dropColumn('role_29');
//            $table->dropColumn('role_30');
//            $table->dropColumn('role_31');
//            $table->dropColumn('role_32');
//            $table->dropColumn('role_33');
//            $table->dropColumn('role_34');
//            $table->dropColumn('role_35');
//            $table->dropColumn('role_36');
//            $table->dropColumn('role_37');
//            $table->dropColumn('role_38');
//            $table->dropColumn('role_39');
//            $table->dropColumn('role_40');
//            $table->dropColumn('role_41');
//            $table->dropColumn('role_42');
//            $table->dropColumn('role_43');
//            $table->dropColumn('role_44');
//            $table->dropColumn('role_45');
//            $table->dropColumn('role_46');
//            $table->dropColumn('role_47');
//            $table->dropColumn('role_48');
//            $table->dropColumn('role_49');
//            $table->dropColumn('role_50');
//            $table->dropColumn('role_51');
//            $table->dropColumn('role_52');
//            $table->dropColumn('attribute_1');
//            $table->dropColumn('attribute_2');
//            $table->dropColumn('attribute_3');
//            $table->dropColumn('attribute_4');
//            $table->dropColumn('attribute_5');
//            $table->dropColumn('attribute_6');
//            $table->dropColumn('attribute_7');
//            $table->dropColumn('attribute_8');
//            $table->dropColumn('mypage_contact_section_1');
//            $table->dropColumn('mypage_contact_section_2');

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
//            $table->string('delivery_suspension', 20)->nullable()->comment("配信停止");
//            $table->string('status', 20)->nullable()->comment("ステータス");
//            $table->text('remarks')->nullable()->comment("自由Ghi chú");
//            $table->text('family_register')->nullable()->comment("戸籍名・旧姓メモ");
//            $table->string('mental_health_worker_registration_number', 20)->nullable()->comment("精神保健福祉士登録番号");
//            $table->string('birth_date', 10)->nullable()->comment("生年月日");
//            $table->string('sex', 3)->nullable()->comment("性別");
//            $table->text('sex_remarks')->nullable()->comment("性別：その他自由記述");
//            $table->string('membership_fee', 20)->nullable()->comment("会費について");
//            $table->string('account_transfer_registration_status', 20)->nullable()->comment("口座振替登録状況");
//            $table->string('next_scheduled_account_transfer_date', 10)->nullable()->comment("次回口座振替予定日");
//            $table->string('send_materials_to', 50)->nullable()->comment("資料送付先");
//            $table->string('information_at_the_time_of_mailing', 100)->nullable()->comment("郵送物送付時情報");
//            $table->string('role_1', 2)->nullable()->comment("役割（役員・支部長等）-理事");
//            $table->string('role_2', 2)->nullable()->comment("役割（役員・支部長等）-常任理事会（正副会長含む）");
//            $table->string('role_3', 2)->nullable()->comment("役割（役員・支部長等）-監事");
//            $table->string('role_4', 2)->nullable()->comment("役割（役員・支部長等）-相談役");
//            $table->string('role_5', 2)->nullable()->comment("役割（役員・支部長等）-名誉会長");
//            $table->string('role_6', 2)->nullable()->comment("役割（役員・支部長等）-代議員");
//            $table->string('role_7', 2)->nullable()->comment("役割（役員・支部長等）-都道府県支部長");
//            $table->string('role_8', 2)->nullable()->comment("役割（役員・支部長等）-都道府県支部事務局長");
//            $table->string('role_9', 2)->nullable()->comment("役割（委員会等）-精神医療・権利擁護委員会");
//            $table->string('role_10', 2)->nullable()->comment("役割（委員会等）-地域生活支援推進委員会");
//            $table->string('role_11', 2)->nullable()->comment("役割（委員会等）-就労・雇用支援の在り方検討委員会");
//            $table->string('role_12', 2)->nullable()->comment("役割（委員会等）-組織強化委員会");
//            $table->string('role_13', 2)->nullable()->comment("役割（委員会等）-災害支援体制整備・復興支援委員会");
//            $table->string('role_14', 2)->nullable()->comment("役割（委員会等）-機関誌編集委員会");
//            $table->string('role_15', 2)->nullable()->comment("役割（委員会等）-刑事司法精神保健福祉委員会");
//            $table->string('role_16', 2)->nullable()->comment("役割（委員会等）-「精神保健福祉士業務指針」委員会（～2021）");
//            $table->string('role_17', 2)->nullable()->comment("役割（委員会等）-東日本大震災復興支援委員会（～2021）");
//            $table->string('role_18', 2)->nullable()->comment("役割（委員会等）-精神保健医療福祉ビジョン策定委員会（～2021）");
//            $table->string('role_19', 2)->nullable()->comment("役割（委員会等）-「精神保健福祉士の倫理綱領」改訂検討委員会");
//            $table->string('role_20', 2)->nullable()->comment("役割（委員会等）-メディア連携委員会");
//            $table->string('role_21', 2)->nullable()->comment("役割（委員会等）-業務調査検討委員会");
//            $table->string('role_22', 2)->nullable()->comment("役割（委員会等）-苦情処理規程改正等特別委員会");
//            $table->string('role_23', 2)->nullable()->comment("役割（委員会等）-依存症及び関連問題対策委員会");
//            $table->string('role_24', 2)->nullable()->comment("役割（委員会等）-子ども・若者・家族支援委員会");
//            $table->string('role_25', 2)->nullable()->comment("役割（委員会等）-クローバー運営委員会");
//            $table->string('role_26', 2)->nullable()->comment("役割（委員会等）-研修企画運営委員会");
//            $table->string('role_27', 2)->nullable()->comment("役割（委員会等）-精神保健福祉士の資質向上検討委員会（～2021）");
//            $table->string('role_28', 2)->nullable()->comment("役割（委員会等）-認定スーパーバイザー養成委員会");
//            $table->string('role_29', 2)->nullable()->comment("役割（委員会等）-認定制度推進委員会");
//            $table->string('role_30', 2)->nullable()->comment("役割（委員会等）-倫理委員会");
//            $table->string('role_31', 2)->nullable()->comment("役割（委員会等）-役員選挙管理委員会（2022～）");
//            $table->string('role_32', 2)->nullable()->comment("役割（委員会等）-代議員選挙管理委員会（2022～）");
//            $table->string('role_33', 2)->nullable()->comment("役割（委員会等）-学会誌投稿論文等査読小委員会");
//            $table->string('role_34', 2)->nullable()->comment("役割（委員会等）-分野別　スクールソーシャルワーク");
//            $table->string('role_35', 2)->nullable()->comment("役割（委員会等）-分野別　認知症");
//            $table->string('role_36', 2)->nullable()->comment("役割（委員会等）-分野別　産業精神保健");
//            $table->string('role_37', 2)->nullable()->comment("役割（委員会等）-分野別　発達障害");
//            $table->string('role_38', 2)->nullable()->comment("役割（委員会等）-分野別　メディア（～2019）");
//            $table->string('role_39', 2)->nullable()->comment("役割（委員会等）-分野別　診療報酬");
//            $table->string('role_40', 2)->nullable()->comment("役割（委員会等）-分野別　貧困問題");
//            $table->string('role_41', 2)->nullable()->comment("役割（委員会等）-分野別　多文化共生ソーシャルワーク");
//            $table->string('role_42', 2)->nullable()->comment("役割（委員会等）-災害対策委員");
//            $table->string('role_43', 2)->nullable()->comment("役割（事業関係等）-55全国大会・18学術集会（愛知県）運営委員会");
//            $table->string('role_44', 2)->nullable()->comment("役割（事業関係等）-18学術集会（愛知県）査読小委員会");
//            $table->string('role_45', 2)->nullable()->comment("役割（事業関係等）-18学術集会（愛知県）分科会座長");
//            $table->string('role_46', 2)->nullable()->comment("役割（事業関係等）-56全国大会・19学術集会（北海道）運営委員会");
//            $table->string('role_47', 2)->nullable()->comment("役割（事業関係等）-19学術集会（北海道）査読小委員会");
//            $table->string('role_48', 2)->nullable()->comment("役割（事業関係等）-19学術集会（北海道）分科会座長");
//            $table->string('role_49', 2)->nullable()->comment("役割（事業関係等）-第7回定時総会運営委員");
//            $table->string('role_50', 2)->nullable()->comment("役割（事業関係等）-R2総合福祉推進事業　事業担当者");
//            $table->string('role_51', 2)->nullable()->comment("役割（事業関係等）-R2総合福祉推進事業　企画検討会議");
//            $table->string('role_52', 2)->nullable()->comment("役割（事業関係等）-2019丸紅助成プロジェクトチーム");
//            $table->string('attribute_1', 2)->nullable()->comment("属性ページ区分-理事");
//            $table->string('attribute_2', 2)->nullable()->comment("属性ページ区分-クローバー登録者");
//            $table->string('attribute_3', 2)->nullable()->comment("属性ページ区分-支部個人情報取扱者");
//            $table->string('attribute_4', 2)->nullable()->comment("属性ページ区分-災害対策委員");
//            $table->string('attribute_5', 2)->nullable()->comment("属性ページ区分-属性C");
//            $table->string('attribute_6', 2)->nullable()->comment("属性ページ区分-属性D");
//            $table->string('attribute_7', 2)->nullable()->comment("属性ページ区分-属性E");
//            $table->string('attribute_8', 2)->nullable()->comment("属性ページ区分-属性F");
//            $table->string('mypage_contact_section_1', 100)->nullable()->comment("マイページ連絡欄（重要）");
//            $table->string('mypage_contact_section_2', 100)->nullable()->comment("マイページ連絡欄（通常）");


        });
    }
};
