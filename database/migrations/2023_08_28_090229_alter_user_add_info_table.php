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
//            $table->dropColumn('newsletter');
//            $table->dropColumn('home_postal_code');
//            $table->dropColumn('home_prefecture');
//            $table->dropColumn('home_cities');
//            $table->dropColumn('home_address');
//            $table->dropColumn('home_name');
//            $table->dropColumn('home_telphone_number');
//            $table->dropColumn('home_fax_number');
//            $table->dropColumn('mobile');
//            $table->dropColumn('office_availability');
//            $table->dropColumn('office_name');
//            $table->dropColumn('office_postal_code');
//            $table->dropColumn('office_prefecture');
//            $table->dropColumn('office_cities');
//            $table->dropColumn('office_address');
//            $table->dropColumn('call_to_acceptable');
//            $table->dropColumn('office_telephone_number');
//            $table->dropColumn('office_extension_number');
//            $table->dropColumn('office_fax_number');
//            $table->dropColumn('employer_type_1');
//            $table->dropColumn('work_type_1');
//            $table->dropColumn('position');
//            $table->dropColumn('management_entity');
//            $table->dropColumn('employment');
//            $table->dropColumn('employer_type_2');
//            $table->dropColumn('work_type_2');
//            $table->dropColumn('employer_type_3');
//            $table->dropColumn('work_type_3');
//            $table->dropColumn('employer_type_4');
//            $table->dropColumn('work_type_4');
//            $table->dropColumn('last_academic_background');
//            $table->dropColumn('examination_route');
//            $table->dropColumn('school_name');
//            $table->dropColumn('graduation_date');
//            $table->dropColumn('social_worker_certification');
//            $table->dropColumn('sicial_worker_obtain_annual');
//            $table->dropColumn('qualifications_licenses_1');
//            $table->dropColumn('qualifications_licenses_2');
//            $table->dropColumn('qualifications_licenses_3');
//            $table->dropColumn('qualifications_licenses_4');
//            $table->dropColumn('qualifications_licenses_5');
//            $table->dropColumn('qualifications_licenses_6');
//            $table->dropColumn('qualifications_licenses_7');
//            $table->dropColumn('qualifications_licenses_8');
//            $table->dropColumn('qualifications_licenses_10');
//            $table->dropColumn('qualifications_licenses_11');
//            $table->dropColumn('qualifications_licenses_12');
//            $table->dropColumn('qualifications_licenses_13');
//            $table->dropColumn('qualifications_licenses_14');
//            $table->dropColumn('qualifications_licenses_15');
//            $table->dropColumn('qualifications_licenses_16');
//            $table->dropColumn('qualifications_licenses_17');
//            $table->dropColumn('qualifications_licenses_18');
//            $table->dropColumn('qualifications_licenses_19');
//            $table->dropColumn('qualifications_licenses_20');
//            $table->dropColumn('qualifications_licenses_21');
//            $table->dropColumn('qualifications_licenses_22');
//            $table->dropColumn('certified_svr_registration_no');
//            $table->dropColumn('clover_registration_year');
//            $table->dropColumn('prefectural_associations_status');
//            $table->dropColumn('prefectural_associatio_1');
//            $table->dropColumn('prefectural_associatio_2');
//            $table->dropColumn('prefectural_associatio_3');
//            $table->dropColumn('prefectural_associatio_4');
//            $table->dropColumn('prefectural_associatio_5');
//            $table->dropColumn('prefectural_associatio_6');
//            $table->dropColumn('prefectural_associatio_7');
//            $table->dropColumn('prefectural_associatio_8');
//            $table->dropColumn('prefectural_associatio_9');
//            $table->dropColumn('prefectural_associatio_10');
//            $table->dropColumn('prefectural_associatio_11');
//            $table->dropColumn('prefectural_associatio_12');
//            $table->dropColumn('prefectural_associatio_13');
//            $table->dropColumn('prefectural_associatio_14');
//            $table->dropColumn('prefectural_associatio_15');
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
//            $table->string('newsletter', 5)->nullable()->comment("メルマガ登録");
//            $table->string('home_postal_code', 10)->nullable()->comment("自宅〒");
//            $table->string('home_prefecture', 6)->nullable()->comment("自宅都道府県");
//            $table->string('home_cities', 100)->nullable()->comment("自宅市区町村");
//            $table->string('home_address', 100)->nullable()->comment("自宅番地");
//            $table->string('home_name', 100)->nullable()->comment("自宅建物名");
//            $table->string('home_telphone_number', 20)->nullable()->comment("自宅TEL");
//            $table->string('home_fax_number', 20)->nullable()->comment("自宅FAX");
//            $table->string('mobile', 13)->nullable()->comment("携帯電話");
//            $table->string('office_availability', 3)->nullable()->comment("ご勤務先の有無について");
//            $table->string('office_name', 100)->nullable()->comment("勤務先機関名");
//            $table->string('office_postal_code', 10)->nullable()->comment("勤務先〒");
//            $table->string('office_prefecture', 6)->nullable()->comment("勤務先都道府県");
//            $table->string('office_cities', 100)->nullable()->comment("勤務先市区町村");
//            $table->string('office_address', 100)->nullable()->comment("勤務先番地");
//            $table->string('call_to_acceptable', 2)->nullable()->comment("勤務先への電話可否");
//            $table->string('office_telephone_number', 20)->nullable()->comment("勤務先TEL");
//            $table->string('office_extension_number', 20)->nullable()->comment("勤務先内線");
//            $table->string('office_fax_number', 20)->nullable()->comment("勤務先FAX");
//            $table->string('employer_type_1', 100)->nullable()->comment("勤務先種別1");
//            $table->string('work_type_1', 100)->nullable()->comment("従事職種1");
//            $table->string('position', 100)->nullable()->comment("勤務先立場");
//            $table->string('management_entity', 100)->nullable()->comment("経営主体");
//            $table->string('employment', 100)->nullable()->comment("雇用形態");
//            $table->string('employer_type_2', 100)->nullable()->comment("勤務先種別2");
//            $table->string('work_type_2', 100)->nullable()->comment("従事職種2");
//            $table->string('employer_type_3', 100)->nullable()->comment("勤務先種別3");
//            $table->string('work_type_3', 100)->nullable()->comment("従事職種3");
//            $table->string('employer_type_4', 100)->nullable()->comment("勤務先種別4");
//            $table->string('work_type_4', 100)->nullable()->comment("従事職種4");
//            $table->string('last_academic_background', 100)->nullable()->comment("最終学歴");
//            $table->string('examination_route', 100)->nullable()->comment("受験ルート");
//            $table->string('school_name', 100)->nullable()->comment("学校名");
//            $table->string('graduation_date', 10)->nullable()->comment("卒業年月");
//            $table->string('social_worker_certification', 3)->nullable()->comment("社会福祉士資格の有無");
//            $table->string('sicial_worker_obtain_annual', 10)->nullable()->comment("社会福祉士取得年度");
//            $table->string('qualifications_licenses_1', 2)->nullable()->comment("所持資格・免許について-01_介護福祉士");
//            $table->string('qualifications_licenses_2', 2)->nullable()->comment("所持資格・免許について-02_保健師");
//            $table->string('qualifications_licenses_3', 2)->nullable()->comment("所持資格・免許について-03_看護師・准看護師");
//            $table->string('qualifications_licenses_4', 2)->nullable()->comment("所持資格・免許について-04_公認心理師");
//            $table->string('qualifications_licenses_5', 2)->nullable()->comment("所持資格・免許について-05_作業療法士");
//            $table->string('qualifications_licenses_6', 2)->nullable()->comment("所持資格・免許について-06_理学療法士");
//            $table->string('qualifications_licenses_7', 2)->nullable()->comment("所持資格・免許について-07_言語聴覚士");
//            $table->string('qualifications_licenses_8', 2)->nullable()->comment("所持資格・免許について-08_医師・歯科医師");
//            $table->string('qualifications_licenses_10', 2)->nullable()->comment("所持資格・免許について-10_幼・小・中・高教諭");
//            $table->string('qualifications_licenses_11', 2)->nullable()->comment("所持資格・免許について-11_特別支援学校教員");
//            $table->string('qualifications_licenses_12', 2)->nullable()->comment("所持資格・免許について-12_栄養士");
//            $table->string('qualifications_licenses_13', 2)->nullable()->comment("所持資格・免許について-13_保育士");
//            $table->string('qualifications_licenses_14', 2)->nullable()->comment("所持資格・免許について-14_児童自立支援専門員");
//            $table->string('qualifications_licenses_15', 2)->nullable()->comment("所持資格・免許について-15_手話通訳士");
//            $table->string('qualifications_licenses_16', 2)->nullable()->comment("所持資格・免許について-16_弁護士");
//            $table->string('qualifications_licenses_17', 2)->nullable()->comment("所持資格・免許について-17_司法書士");
//            $table->string('qualifications_licenses_18', 2)->nullable()->comment("所持資格・免許について-18_行政書士");
//            $table->string('qualifications_licenses_19', 2)->nullable()->comment("所持資格・免許について-19_社会保険労務士");
//            $table->string('qualifications_licenses_20', 2)->nullable()->comment("所持資格・免許について-20_介護支援専門員");
//            $table->string('qualifications_licenses_21', 2)->nullable()->comment("所持資格・免許について-21_相談支援専門員");
//            $table->string('qualifications_licenses_22', 2)->nullable()->comment("所持資格・免許について-22_サービス管理責任者");
//            $table->string('certified_svr_registration_no', 20)->nullable()->comment("認定SVR登録No");
//            $table->string('clover_registration_year', 10)->nullable()->comment("クローバー登録年度");
//            $table->string('prefectural_associations_status', 100)->nullable()->comment("都道府県協会等への入会状況");
//            $table->string('prefectural_associatio_1', 2)->nullable()->comment("入会している都道府県協会-北海道");
//            $table->string('prefectural_associatio_2', 2)->nullable()->comment("入会している都道府県協会-青森県");
//            $table->string('prefectural_associatio_3', 2)->nullable()->comment("入会している都道府県協会-岩手県");
//            $table->string('prefectural_associatio_4', 2)->nullable()->comment("入会している都道府県協会-宮城県");
//            $table->string('prefectural_associatio_5', 2)->nullable()->comment("入会している都道府県協会-秋田県");
//            $table->string('prefectural_associatio_6', 2)->nullable()->comment("入会している都道府県協会-山形県");
//            $table->string('prefectural_associatio_7', 2)->nullable()->comment("入会している都道府県協会-福島県");
//            $table->string('prefectural_associatio_8', 2)->nullable()->comment("入会している都道府県協会-茨城県");
//            $table->string('prefectural_associatio_9', 2)->nullable()->comment("入会している都道府県協会-栃木県");
//            $table->string('prefectural_associatio_10', 2)->nullable()->comment("入会している都道府県協会-群馬県");
//            $table->string('prefectural_associatio_11', 2)->nullable()->comment("入会している都道府県協会-埼玉県");
//            $table->string('prefectural_associatio_12', 2)->nullable()->comment("入会している都道府県協会-千葉県");
//            $table->string('prefectural_associatio_13', 2)->nullable()->comment("入会している都道府県協会-東京都");
//            $table->string('prefectural_associatio_14', 2)->nullable()->comment("入会している都道府県協会-神奈川県");
//            $table->string('prefectural_associatio_15', 2)->nullable()->comment("入会している都道府県協会-新潟県");
        });
    }
};
