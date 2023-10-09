<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $id
 * @property int      $id
 * @property int      $users_id
 * @property int      $users_id
 * @property string   $absence_year
 * @property string   $account_transfer_registration_status
 * @property string   $approval_date
 * @property string   $attribute_1
 * @property string   $attribute_2
 * @property string   $attribute_3
 * @property string   $attribute_4
 * @property string   $attribute_5
 * @property string   $attribute_6
 * @property string   $attribute_7
 * @property string   $attribute_8
 * @property string   $authorized_individual_form
 * @property string   $birth_date
 * @property string   $branch_general_meeting
 * @property string   $call_to_acceptable
 * @property string   $certification_number
 * @property string   $certification_year
 * @property string   $certified_svr_registration
 * @property string   $certified_svr_registration_no
 * @property string   $clover_affiliated_address
 * @property string   $clover_affiliated_mail_status
 * @property string   $clover_family_1
 * @property string   $clover_family_2
 * @property string   $clover_family_3
 * @property string   $clover_family_4
 * @property string   $clover_family_5
 * @property string   $clover_family_6
 * @property string   $clover_family_7
 * @property string   $clover_family_8
 * @property string   $clover_home_email
 * @property string   $clover_individual_important_contact_column
 * @property string   $clover_mail_etc
 * @property string   $clover_mailing_list_registration
 * @property string   $clover_registration
 * @property string   $clover_registration_fee_paid
 * @property string   $clover_registration_year
 * @property string   $continuing_training_attendance_cycle
 * @property string   $core_training_status
 * @property string   $core_training_year
 * @property string   $delivery_suspension
 * @property string   $email
 * @property string   $employer_type_1
 * @property string   $employer_type_2
 * @property string   $employer_type_3
 * @property string   $employer_type_4
 * @property string   $employment
 * @property string   $etc_mailing_list_registration
 * @property string   $examination_route
 * @property string   $family_register
 * @property string   $free_text_1
 * @property string   $free_text_2
 * @property string   $free_text_3
 * @property string   $graduation_date
 * @property string   $group_training_participation
 * @property string   $home_address
 * @property string   $home_cities
 * @property string   $home_fax_number
 * @property string   $home_mailing_list_registration
 * @property string   $home_name
 * @property string   $home_postal_code
 * @property string   $home_prefecture
 * @property string   $home_telphone_number
 * @property string   $how_pay_registration_fee
 * @property string   $information_at_the_time_of_mailing
 * @property string   $intention_accept_appointment
 * @property string   $kana1
 * @property string   $kana2
 * @property string   $last_academic_background
 * @property string   $login_id
 * @property string   $management_entity
 * @property string   $member_id
 * @property string   $membership_fee
 * @property string   $membership_type
 * @property string   $mental_health_worker_registration_number
 * @property string   $mobile
 * @property string   $mypage_contact_section_1
 * @property string   $mypage_contact_section_2
 * @property string   $name1
 * @property string   $name2
 * @property string   $need_attend_group_training_within_cycle
 * @property string   $newsletter
 * @property string   $next_scheduled_account_transfer_date
 * @property string   $office_address
 * @property string   $office_availability
 * @property string   $office_cities
 * @property string   $office_extension_number
 * @property string   $office_fax_number
 * @property string   $office_management_memo_1
 * @property string   $office_management_memo_2
 * @property string   $office_management_memo_3
 * @property string   $office_management_memo_4
 * @property string   $office_management_memo_5
 * @property string   $office_management_memo_6
 * @property string   $office_management_memo_7
 * @property string   $office_management_memo_8
 * @property string   $office_management_memo_9
 * @property string   $office_name
 * @property string   $office_postal_code
 * @property string   $office_prefecture
 * @property string   $office_telephone_number
 * @property string   $partner_registration
 * @property string   $position
 * @property string   $prefectural_associatio_1
 * @property string   $prefectural_associatio_10
 * @property string   $prefectural_associatio_11
 * @property string   $prefectural_associatio_12
 * @property string   $prefectural_associatio_13
 * @property string   $prefectural_associatio_14
 * @property string   $prefectural_associatio_15
 * @property string   $prefectural_associatio_16
 * @property string   $prefectural_associatio_17
 * @property string   $prefectural_associatio_18
 * @property string   $prefectural_associatio_19
 * @property string   $prefectural_associatio_2
 * @property string   $prefectural_associatio_20
 * @property string   $prefectural_associatio_21
 * @property string   $prefectural_associatio_22
 * @property string   $prefectural_associatio_23
 * @property string   $prefectural_associatio_24
 * @property string   $prefectural_associatio_25
 * @property string   $prefectural_associatio_26
 * @property string   $prefectural_associatio_27
 * @property string   $prefectural_associatio_28
 * @property string   $prefectural_associatio_29
 * @property string   $prefectural_associatio_3
 * @property string   $prefectural_associatio_30
 * @property string   $prefectural_associatio_31
 * @property string   $prefectural_associatio_32
 * @property string   $prefectural_associatio_33
 * @property string   $prefectural_associatio_34
 * @property string   $prefectural_associatio_35
 * @property string   $prefectural_associatio_36
 * @property string   $prefectural_associatio_37
 * @property string   $prefectural_associatio_38
 * @property string   $prefectural_associatio_39
 * @property string   $prefectural_associatio_4
 * @property string   $prefectural_associatio_40
 * @property string   $prefectural_associatio_41
 * @property string   $prefectural_associatio_42
 * @property string   $prefectural_associatio_43
 * @property string   $prefectural_associatio_44
 * @property string   $prefectural_associatio_45
 * @property string   $prefectural_associatio_46
 * @property string   $prefectural_associatio_47
 * @property string   $prefectural_associatio_5
 * @property string   $prefectural_associatio_6
 * @property string   $prefectural_associatio_7
 * @property string   $prefectural_associatio_8
 * @property string   $prefectural_associatio_9
 * @property string   $prefectural_associations_status
 * @property string   $prefectural_chapters
 * @property string   $purchase_of_training_textbooks_1
 * @property string   $purchase_of_training_textbooks_2
 * @property string   $purchase_of_training_textbooks_3
 * @property string   $qualifications_licenses_1
 * @property string   $qualifications_licenses_10
 * @property string   $qualifications_licenses_11
 * @property string   $qualifications_licenses_12
 * @property string   $qualifications_licenses_13
 * @property string   $qualifications_licenses_14
 * @property string   $qualifications_licenses_15
 * @property string   $qualifications_licenses_16
 * @property string   $qualifications_licenses_17
 * @property string   $qualifications_licenses_18
 * @property string   $qualifications_licenses_19
 * @property string   $qualifications_licenses_2
 * @property string   $qualifications_licenses_20
 * @property string   $qualifications_licenses_21
 * @property string   $qualifications_licenses_22
 * @property string   $qualifications_licenses_3
 * @property string   $qualifications_licenses_4
 * @property string   $qualifications_licenses_5
 * @property string   $qualifications_licenses_6
 * @property string   $qualifications_licenses_7
 * @property string   $qualifications_licenses_8
 * @property string   $reason
 * @property string   $reasonable_accommodation
 * @property string   $reinstatement_year
 * @property string   $remarks
 * @property string   $renewal_training_course_extension_status
 * @property string   $renewal_training_course_extension_year
 * @property string   $role_1
 * @property string   $role_10
 * @property string   $role_11
 * @property string   $role_12
 * @property string   $role_13
 * @property string   $role_14
 * @property string   $role_15
 * @property string   $role_16
 * @property string   $role_17
 * @property string   $role_18
 * @property string   $role_19
 * @property string   $role_2
 * @property string   $role_20
 * @property string   $role_21
 * @property string   $role_22
 * @property string   $role_23
 * @property string   $role_24
 * @property string   $role_25
 * @property string   $role_26
 * @property string   $role_27
 * @property string   $role_28
 * @property string   $role_29
 * @property string   $role_3
 * @property string   $role_30
 * @property string   $role_31
 * @property string   $role_32
 * @property string   $role_33
 * @property string   $role_34
 * @property string   $role_35
 * @property string   $role_36
 * @property string   $role_37
 * @property string   $role_38
 * @property string   $role_39
 * @property string   $role_4
 * @property string   $role_40
 * @property string   $role_41
 * @property string   $role_42
 * @property string   $role_43
 * @property string   $role_44
 * @property string   $role_45
 * @property string   $role_46
 * @property string   $role_47
 * @property string   $role_48
 * @property string   $role_49
 * @property string   $role_5
 * @property string   $role_50
 * @property string   $role_51
 * @property string   $role_52
 * @property string   $role_6
 * @property string   $role_7
 * @property string   $role_8
 * @property string   $role_9
 * @property string   $scheduled_reinstatement_year
 * @property string   $school_name
 * @property string   $send_materials_to
 * @property string   $sex
 * @property string   $sex_remarks
 * @property string   $sicial_worker_obtain_annual
 * @property string   $social_worker_certification
 * @property string   $status
 * @property string   $training_accreditation_certification_status
 * @property string   $training_accreditation_certification_year
 * @property string   $training_individual_form
 * @property string   $withdrawal_date
 * @property string   $work_type_1
 * @property string   $work_type_2
 * @property string   $work_type_3
 * @property string   $work_type_4
 * @property string   $absence_year
 * @property string   $account_transfer_registration_status
 * @property string   $approval_date
 * @property string   $attribute_1
 * @property string   $attribute_2
 * @property string   $attribute_3
 * @property string   $attribute_4
 * @property string   $attribute_5
 * @property string   $attribute_6
 * @property string   $attribute_7
 * @property string   $attribute_8
 * @property string   $authorized_individual_form
 * @property string   $birth_date
 * @property string   $branch_general_meeting
 * @property string   $call_to_acceptable
 * @property string   $certification_number
 * @property string   $certification_year
 * @property string   $certified_svr_registration
 * @property string   $certified_svr_registration_no
 * @property string   $clover_affiliated_address
 * @property string   $clover_affiliated_mail_status
 * @property string   $clover_family_1
 * @property string   $clover_family_2
 * @property string   $clover_family_3
 * @property string   $clover_family_4
 * @property string   $clover_family_5
 * @property string   $clover_family_6
 * @property string   $clover_family_7
 * @property string   $clover_family_8
 * @property string   $clover_home_email
 * @property string   $clover_individual_important_contact_column
 * @property string   $clover_mail_etc
 * @property string   $clover_mailing_list_registration
 * @property string   $clover_registration
 * @property string   $clover_registration_fee_paid
 * @property string   $clover_registration_year
 * @property string   $continuing_training_attendance_cycle
 * @property string   $core_training_status
 * @property string   $core_training_year
 * @property string   $delivery_suspension
 * @property string   $email
 * @property string   $employer_type_1
 * @property string   $employer_type_2
 * @property string   $employer_type_3
 * @property string   $employer_type_4
 * @property string   $employment
 * @property string   $etc_mailing_list_registration
 * @property string   $examination_route
 * @property string   $family_register
 * @property string   $free_text_1
 * @property string   $free_text_2
 * @property string   $free_text_3
 * @property string   $graduation_date
 * @property string   $group_training_participation
 * @property string   $home_address
 * @property string   $home_cities
 * @property string   $home_fax_number
 * @property string   $home_mailing_list_registration
 * @property string   $home_name
 * @property string   $home_postal_code
 * @property string   $home_prefecture
 * @property string   $home_telphone_number
 * @property string   $how_pay_registration_fee
 * @property string   $information_at_the_time_of_mailing
 * @property string   $intention_accept_appointment
 * @property string   $kana1
 * @property string   $kana2
 * @property string   $last_academic_background
 * @property string   $login_id
 * @property string   $management_entity
 * @property string   $member_id
 * @property string   $membership_fee
 * @property string   $membership_type
 * @property string   $mental_health_worker_registration_number
 * @property string   $mobile
 * @property string   $mypage_contact_section_1
 * @property string   $mypage_contact_section_2
 * @property string   $name1
 * @property string   $name2
 * @property string   $need_attend_group_training_within_cycle
 * @property string   $newsletter
 * @property string   $next_scheduled_account_transfer_date
 * @property string   $office_address
 * @property string   $office_availability
 * @property string   $office_cities
 * @property string   $office_extension_number
 * @property string   $office_fax_number
 * @property string   $office_management_memo_1
 * @property string   $office_management_memo_2
 * @property string   $office_management_memo_3
 * @property string   $office_management_memo_4
 * @property string   $office_management_memo_5
 * @property string   $office_management_memo_6
 * @property string   $office_management_memo_7
 * @property string   $office_management_memo_8
 * @property string   $office_management_memo_9
 * @property string   $office_name
 * @property string   $office_postal_code
 * @property string   $office_prefecture
 * @property string   $office_telephone_number
 * @property string   $partner_registration
 * @property string   $position
 * @property string   $prefectural_associatio_1
 * @property string   $prefectural_associatio_10
 * @property string   $prefectural_associatio_11
 * @property string   $prefectural_associatio_12
 * @property string   $prefectural_associatio_13
 * @property string   $prefectural_associatio_14
 * @property string   $prefectural_associatio_15
 * @property string   $prefectural_associatio_16
 * @property string   $prefectural_associatio_17
 * @property string   $prefectural_associatio_18
 * @property string   $prefectural_associatio_19
 * @property string   $prefectural_associatio_2
 * @property string   $prefectural_associatio_20
 * @property string   $prefectural_associatio_21
 * @property string   $prefectural_associatio_22
 * @property string   $prefectural_associatio_23
 * @property string   $prefectural_associatio_24
 * @property string   $prefectural_associatio_25
 * @property string   $prefectural_associatio_26
 * @property string   $prefectural_associatio_27
 * @property string   $prefectural_associatio_28
 * @property string   $prefectural_associatio_29
 * @property string   $prefectural_associatio_3
 * @property string   $prefectural_associatio_30
 * @property string   $prefectural_associatio_31
 * @property string   $prefectural_associatio_32
 * @property string   $prefectural_associatio_33
 * @property string   $prefectural_associatio_34
 * @property string   $prefectural_associatio_35
 * @property string   $prefectural_associatio_36
 * @property string   $prefectural_associatio_37
 * @property string   $prefectural_associatio_38
 * @property string   $prefectural_associatio_39
 * @property string   $prefectural_associatio_4
 * @property string   $prefectural_associatio_40
 * @property string   $prefectural_associatio_41
 * @property string   $prefectural_associatio_42
 * @property string   $prefectural_associatio_43
 * @property string   $prefectural_associatio_44
 * @property string   $prefectural_associatio_45
 * @property string   $prefectural_associatio_46
 * @property string   $prefectural_associatio_47
 * @property string   $prefectural_associatio_5
 * @property string   $prefectural_associatio_6
 * @property string   $prefectural_associatio_7
 * @property string   $prefectural_associatio_8
 * @property string   $prefectural_associatio_9
 * @property string   $prefectural_associations_status
 * @property string   $prefectural_chapters
 * @property string   $purchase_of_training_textbooks_1
 * @property string   $purchase_of_training_textbooks_2
 * @property string   $purchase_of_training_textbooks_3
 * @property string   $qualifications_licenses_1
 * @property string   $qualifications_licenses_10
 * @property string   $qualifications_licenses_11
 * @property string   $qualifications_licenses_12
 * @property string   $qualifications_licenses_13
 * @property string   $qualifications_licenses_14
 * @property string   $qualifications_licenses_15
 * @property string   $qualifications_licenses_16
 * @property string   $qualifications_licenses_17
 * @property string   $qualifications_licenses_18
 * @property string   $qualifications_licenses_19
 * @property string   $qualifications_licenses_2
 * @property string   $qualifications_licenses_20
 * @property string   $qualifications_licenses_21
 * @property string   $qualifications_licenses_22
 * @property string   $qualifications_licenses_3
 * @property string   $qualifications_licenses_4
 * @property string   $qualifications_licenses_5
 * @property string   $qualifications_licenses_6
 * @property string   $qualifications_licenses_7
 * @property string   $qualifications_licenses_8
 * @property string   $reason
 * @property string   $reasonable_accommodation
 * @property string   $reinstatement_year
 * @property string   $remarks
 * @property string   $renewal_training_course_extension_status
 * @property string   $renewal_training_course_extension_year
 * @property string   $role_1
 * @property string   $role_10
 * @property string   $role_11
 * @property string   $role_12
 * @property string   $role_13
 * @property string   $role_14
 * @property string   $role_15
 * @property string   $role_16
 * @property string   $role_17
 * @property string   $role_18
 * @property string   $role_19
 * @property string   $role_2
 * @property string   $role_20
 * @property string   $role_21
 * @property string   $role_22
 * @property string   $role_23
 * @property string   $role_24
 * @property string   $role_25
 * @property string   $role_26
 * @property string   $role_27
 * @property string   $role_28
 * @property string   $role_29
 * @property string   $role_3
 * @property string   $role_30
 * @property string   $role_31
 * @property string   $role_32
 * @property string   $role_33
 * @property string   $role_34
 * @property string   $role_35
 * @property string   $role_36
 * @property string   $role_37
 * @property string   $role_38
 * @property string   $role_39
 * @property string   $role_4
 * @property string   $role_40
 * @property string   $role_41
 * @property string   $role_42
 * @property string   $role_43
 * @property string   $role_44
 * @property string   $role_45
 * @property string   $role_46
 * @property string   $role_47
 * @property string   $role_48
 * @property string   $role_49
 * @property string   $role_5
 * @property string   $role_50
 * @property string   $role_51
 * @property string   $role_52
 * @property string   $role_6
 * @property string   $role_7
 * @property string   $role_8
 * @property string   $role_9
 * @property string   $scheduled_reinstatement_year
 * @property string   $school_name
 * @property string   $send_materials_to
 * @property string   $sex
 * @property string   $sex_remarks
 * @property string   $sicial_worker_obtain_annual
 * @property string   $social_worker_certification
 * @property string   $status
 * @property string   $training_accreditation_certification_status
 * @property string   $training_accreditation_certification_year
 * @property string   $training_individual_form
 * @property string   $withdrawal_date
 * @property string   $work_type_1
 * @property string   $work_type_2
 * @property string   $work_type_3
 * @property string   $work_type_4
 * @property DateTime $registration_date
 * @property DateTime $registration_date
 */
class UsersAddInfo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_add_info';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'absence_year', 'account_transfer_registration_status', 'approval_date', 'attribute_1', 'attribute_2', 'attribute_3', 'attribute_4', 'attribute_5', 'attribute_6', 'attribute_7', 'attribute_8', 'authorized_individual_form', 'birth_date', 'branch_general_meeting', 'call_to_acceptable', 'certification_number', 'certification_year', 'certified_svr_registration', 'certified_svr_registration_no', 'clover_affiliated_address', 'clover_affiliated_mail_status', 'clover_family_1', 'clover_family_2', 'clover_family_3', 'clover_family_4', 'clover_family_5', 'clover_family_6', 'clover_family_7', 'clover_family_8', 'clover_home_email', 'clover_individual_important_contact_column', 'clover_mail_etc', 'clover_mailing_list_registration', 'clover_registration', 'clover_registration_fee_paid', 'clover_registration_year', 'continuing_training_attendance_cycle', 'core_training_status', 'core_training_year', 'delivery_suspension', 'email', 'employer_type_1', 'employer_type_2', 'employer_type_3', 'employer_type_4', 'employment', 'etc_mailing_list_registration', 'examination_route', 'family_register', 'free_text_1', 'free_text_2', 'free_text_3', 'graduation_date', 'group_training_participation', 'home_address', 'home_cities', 'home_fax_number', 'home_mailing_list_registration', 'home_name', 'home_postal_code', 'home_prefecture', 'home_telphone_number', 'how_pay_registration_fee', 'information_at_the_time_of_mailing', 'intention_accept_appointment', 'kana1', 'kana2', 'last_academic_background', 'login_id', 'management_entity', 'member_id', 'membership_fee', 'membership_type', 'mental_health_worker_registration_number', 'mobile', 'mypage_contact_section_1', 'mypage_contact_section_2', 'name1', 'name2', 'need_attend_group_training_within_cycle', 'newsletter', 'next_scheduled_account_transfer_date', 'office_address', 'office_availability', 'office_cities', 'office_extension_number', 'office_fax_number', 'office_management_memo_1', 'office_management_memo_2', 'office_management_memo_3', 'office_management_memo_4', 'office_management_memo_5', 'office_management_memo_6', 'office_management_memo_7', 'office_management_memo_8', 'office_management_memo_9', 'office_name', 'office_postal_code', 'office_prefecture', 'office_telephone_number', 'partner_registration', 'position', 'prefectural_associatio_1', 'prefectural_associatio_10', 'prefectural_associatio_11', 'prefectural_associatio_12', 'prefectural_associatio_13', 'prefectural_associatio_14', 'prefectural_associatio_15', 'prefectural_associatio_16', 'prefectural_associatio_17', 'prefectural_associatio_18', 'prefectural_associatio_19', 'prefectural_associatio_2', 'prefectural_associatio_20', 'prefectural_associatio_21', 'prefectural_associatio_22', 'prefectural_associatio_23', 'prefectural_associatio_24', 'prefectural_associatio_25', 'prefectural_associatio_26', 'prefectural_associatio_27', 'prefectural_associatio_28', 'prefectural_associatio_29', 'prefectural_associatio_3', 'prefectural_associatio_30', 'prefectural_associatio_31', 'prefectural_associatio_32', 'prefectural_associatio_33', 'prefectural_associatio_34', 'prefectural_associatio_35', 'prefectural_associatio_36', 'prefectural_associatio_37', 'prefectural_associatio_38', 'prefectural_associatio_39', 'prefectural_associatio_4', 'prefectural_associatio_40', 'prefectural_associatio_41', 'prefectural_associatio_42', 'prefectural_associatio_43', 'prefectural_associatio_44', 'prefectural_associatio_45', 'prefectural_associatio_46', 'prefectural_associatio_47', 'prefectural_associatio_5', 'prefectural_associatio_6', 'prefectural_associatio_7', 'prefectural_associatio_8', 'prefectural_associatio_9', 'prefectural_associations_status', 'prefectural_chapters', 'purchase_of_training_textbooks_1', 'purchase_of_training_textbooks_2', 'purchase_of_training_textbooks_3', 'qualifications_licenses_1', 'qualifications_licenses_10', 'qualifications_licenses_11', 'qualifications_licenses_12', 'qualifications_licenses_13', 'qualifications_licenses_14', 'qualifications_licenses_15', 'qualifications_licenses_16', 'qualifications_licenses_17', 'qualifications_licenses_18', 'qualifications_licenses_19', 'qualifications_licenses_2', 'qualifications_licenses_20', 'qualifications_licenses_21', 'qualifications_licenses_22', 'qualifications_licenses_3', 'qualifications_licenses_4', 'qualifications_licenses_5', 'qualifications_licenses_6', 'qualifications_licenses_7', 'qualifications_licenses_8', 'reason', 'reasonable_accommodation', 'registration_date', 'reinstatement_year', 'remarks', 'renewal_training_course_extension_status', 'renewal_training_course_extension_year', 'role_1', 'role_10', 'role_11', 'role_12', 'role_13', 'role_14', 'role_15', 'role_16', 'role_17', 'role_18', 'role_19', 'role_2', 'role_20', 'role_21', 'role_22', 'role_23', 'role_24', 'role_25', 'role_26', 'role_27', 'role_28', 'role_29', 'role_3', 'role_30', 'role_31', 'role_32', 'role_33', 'role_34', 'role_35', 'role_36', 'role_37', 'role_38', 'role_39', 'role_4', 'role_40', 'role_41', 'role_42', 'role_43', 'role_44', 'role_45', 'role_46', 'role_47', 'role_48', 'role_49', 'role_5', 'role_50', 'role_51', 'role_52', 'role_6', 'role_7', 'role_8', 'role_9', 'scheduled_reinstatement_year', 'school_name', 'send_materials_to', 'sex', 'sex_remarks', 'sicial_worker_obtain_annual', 'social_worker_certification', 'status', 'training_accreditation_certification_status', 'training_accreditation_certification_year', 'training_individual_form', 'users_id', 'withdrawal_date', 'work_type_1', 'work_type_2', 'work_type_3', 'work_type_4', 'absence_year', 'account_transfer_registration_status', 'approval_date', 'attribute_1', 'attribute_2', 'attribute_3', 'attribute_4', 'attribute_5', 'attribute_6', 'attribute_7', 'attribute_8', 'authorized_individual_form', 'birth_date', 'branch_general_meeting', 'call_to_acceptable', 'certification_number', 'certification_year', 'certified_svr_registration', 'certified_svr_registration_no', 'clover_affiliated_address', 'clover_affiliated_mail_status', 'clover_family_1', 'clover_family_2', 'clover_family_3', 'clover_family_4', 'clover_family_5', 'clover_family_6', 'clover_family_7', 'clover_family_8', 'clover_home_email', 'clover_individual_important_contact_column', 'clover_mail_etc', 'clover_mailing_list_registration', 'clover_registration', 'clover_registration_fee_paid', 'clover_registration_year', 'continuing_training_attendance_cycle', 'core_training_status', 'core_training_year', 'delivery_suspension', 'email', 'employer_type_1', 'employer_type_2', 'employer_type_3', 'employer_type_4', 'employment', 'etc_mailing_list_registration', 'examination_route', 'family_register', 'free_text_1', 'free_text_2', 'free_text_3', 'graduation_date', 'group_training_participation', 'home_address', 'home_cities', 'home_fax_number', 'home_mailing_list_registration', 'home_name', 'home_postal_code', 'home_prefecture', 'home_telphone_number', 'how_pay_registration_fee', 'information_at_the_time_of_mailing', 'intention_accept_appointment', 'kana1', 'kana2', 'last_academic_background', 'login_id', 'management_entity', 'member_id', 'membership_fee', 'membership_type', 'mental_health_worker_registration_number', 'mobile', 'mypage_contact_section_1', 'mypage_contact_section_2', 'name1', 'name2', 'need_attend_group_training_within_cycle', 'newsletter', 'next_scheduled_account_transfer_date', 'office_address', 'office_availability', 'office_cities', 'office_extension_number', 'office_fax_number', 'office_management_memo_1', 'office_management_memo_2', 'office_management_memo_3', 'office_management_memo_4', 'office_management_memo_5', 'office_management_memo_6', 'office_management_memo_7', 'office_management_memo_8', 'office_management_memo_9', 'office_name', 'office_postal_code', 'office_prefecture', 'office_telephone_number', 'partner_registration', 'position', 'prefectural_associatio_1', 'prefectural_associatio_10', 'prefectural_associatio_11', 'prefectural_associatio_12', 'prefectural_associatio_13', 'prefectural_associatio_14', 'prefectural_associatio_15', 'prefectural_associatio_16', 'prefectural_associatio_17', 'prefectural_associatio_18', 'prefectural_associatio_19', 'prefectural_associatio_2', 'prefectural_associatio_20', 'prefectural_associatio_21', 'prefectural_associatio_22', 'prefectural_associatio_23', 'prefectural_associatio_24', 'prefectural_associatio_25', 'prefectural_associatio_26', 'prefectural_associatio_27', 'prefectural_associatio_28', 'prefectural_associatio_29', 'prefectural_associatio_3', 'prefectural_associatio_30', 'prefectural_associatio_31', 'prefectural_associatio_32', 'prefectural_associatio_33', 'prefectural_associatio_34', 'prefectural_associatio_35', 'prefectural_associatio_36', 'prefectural_associatio_37', 'prefectural_associatio_38', 'prefectural_associatio_39', 'prefectural_associatio_4', 'prefectural_associatio_40', 'prefectural_associatio_41', 'prefectural_associatio_42', 'prefectural_associatio_43', 'prefectural_associatio_44', 'prefectural_associatio_45', 'prefectural_associatio_46', 'prefectural_associatio_47', 'prefectural_associatio_5', 'prefectural_associatio_6', 'prefectural_associatio_7', 'prefectural_associatio_8', 'prefectural_associatio_9', 'prefectural_associations_status', 'prefectural_chapters', 'purchase_of_training_textbooks_1', 'purchase_of_training_textbooks_2', 'purchase_of_training_textbooks_3', 'qualifications_licenses_1', 'qualifications_licenses_10', 'qualifications_licenses_11', 'qualifications_licenses_12', 'qualifications_licenses_13', 'qualifications_licenses_14', 'qualifications_licenses_15', 'qualifications_licenses_16', 'qualifications_licenses_17', 'qualifications_licenses_18', 'qualifications_licenses_19', 'qualifications_licenses_2', 'qualifications_licenses_20', 'qualifications_licenses_21', 'qualifications_licenses_22', 'qualifications_licenses_3', 'qualifications_licenses_4', 'qualifications_licenses_5', 'qualifications_licenses_6', 'qualifications_licenses_7', 'qualifications_licenses_8', 'reason', 'reasonable_accommodation', 'registration_date', 'reinstatement_year', 'remarks', 'renewal_training_course_extension_status', 'renewal_training_course_extension_year', 'role_1', 'role_10', 'role_11', 'role_12', 'role_13', 'role_14', 'role_15', 'role_16', 'role_17', 'role_18', 'role_19', 'role_2', 'role_20', 'role_21', 'role_22', 'role_23', 'role_24', 'role_25', 'role_26', 'role_27', 'role_28', 'role_29', 'role_3', 'role_30', 'role_31', 'role_32', 'role_33', 'role_34', 'role_35', 'role_36', 'role_37', 'role_38', 'role_39', 'role_4', 'role_40', 'role_41', 'role_42', 'role_43', 'role_44', 'role_45', 'role_46', 'role_47', 'role_48', 'role_49', 'role_5', 'role_50', 'role_51', 'role_52', 'role_6', 'role_7', 'role_8', 'role_9', 'scheduled_reinstatement_year', 'school_name', 'send_materials_to', 'sex', 'sex_remarks', 'sicial_worker_obtain_annual', 'social_worker_certification', 'status', 'training_accreditation_certification_status', 'training_accreditation_certification_year', 'training_individual_form', 'users_id', 'withdrawal_date', 'work_type_1', 'work_type_2', 'work_type_3', 'work_type_4'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'id' => 'int', 'absence_year' => 'string', 'account_transfer_registration_status' => 'string', 'approval_date' => 'string', 'attribute_1' => 'string', 'attribute_2' => 'string', 'attribute_3' => 'string', 'attribute_4' => 'string', 'attribute_5' => 'string', 'attribute_6' => 'string', 'attribute_7' => 'string', 'attribute_8' => 'string', 'authorized_individual_form' => 'string', 'birth_date' => 'string', 'branch_general_meeting' => 'string', 'call_to_acceptable' => 'string', 'certification_number' => 'string', 'certification_year' => 'string', 'certified_svr_registration' => 'string', 'certified_svr_registration_no' => 'string', 'clover_affiliated_address' => 'string', 'clover_affiliated_mail_status' => 'string', 'clover_family_1' => 'string', 'clover_family_2' => 'string', 'clover_family_3' => 'string', 'clover_family_4' => 'string', 'clover_family_5' => 'string', 'clover_family_6' => 'string', 'clover_family_7' => 'string', 'clover_family_8' => 'string', 'clover_home_email' => 'string', 'clover_individual_important_contact_column' => 'string', 'clover_mail_etc' => 'string', 'clover_mailing_list_registration' => 'string', 'clover_registration' => 'string', 'clover_registration_fee_paid' => 'string', 'clover_registration_year' => 'string', 'continuing_training_attendance_cycle' => 'string', 'core_training_status' => 'string', 'core_training_year' => 'string', 'delivery_suspension' => 'string', 'email' => 'string', 'employer_type_1' => 'string', 'employer_type_2' => 'string', 'employer_type_3' => 'string', 'employer_type_4' => 'string', 'employment' => 'string', 'etc_mailing_list_registration' => 'string', 'examination_route' => 'string', 'family_register' => 'string', 'free_text_1' => 'string', 'free_text_2' => 'string', 'free_text_3' => 'string', 'graduation_date' => 'string', 'group_training_participation' => 'string', 'home_address' => 'string', 'home_cities' => 'string', 'home_fax_number' => 'string', 'home_mailing_list_registration' => 'string', 'home_name' => 'string', 'home_postal_code' => 'string', 'home_prefecture' => 'string', 'home_telphone_number' => 'string', 'how_pay_registration_fee' => 'string', 'information_at_the_time_of_mailing' => 'string', 'intention_accept_appointment' => 'string', 'kana1' => 'string', 'kana2' => 'string', 'last_academic_background' => 'string', 'login_id' => 'string', 'management_entity' => 'string', 'member_id' => 'string', 'membership_fee' => 'string', 'membership_type' => 'string', 'mental_health_worker_registration_number' => 'string', 'mobile' => 'string', 'mypage_contact_section_1' => 'string', 'mypage_contact_section_2' => 'string', 'name1' => 'string', 'name2' => 'string', 'need_attend_group_training_within_cycle' => 'string', 'newsletter' => 'string', 'next_scheduled_account_transfer_date' => 'string', 'office_address' => 'string', 'office_availability' => 'string', 'office_cities' => 'string', 'office_extension_number' => 'string', 'office_fax_number' => 'string', 'office_management_memo_1' => 'string', 'office_management_memo_2' => 'string', 'office_management_memo_3' => 'string', 'office_management_memo_4' => 'string', 'office_management_memo_5' => 'string', 'office_management_memo_6' => 'string', 'office_management_memo_7' => 'string', 'office_management_memo_8' => 'string', 'office_management_memo_9' => 'string', 'office_name' => 'string', 'office_postal_code' => 'string', 'office_prefecture' => 'string', 'office_telephone_number' => 'string', 'partner_registration' => 'string', 'position' => 'string', 'prefectural_associatio_1' => 'string', 'prefectural_associatio_10' => 'string', 'prefectural_associatio_11' => 'string', 'prefectural_associatio_12' => 'string', 'prefectural_associatio_13' => 'string', 'prefectural_associatio_14' => 'string', 'prefectural_associatio_15' => 'string', 'prefectural_associatio_16' => 'string', 'prefectural_associatio_17' => 'string', 'prefectural_associatio_18' => 'string', 'prefectural_associatio_19' => 'string', 'prefectural_associatio_2' => 'string', 'prefectural_associatio_20' => 'string', 'prefectural_associatio_21' => 'string', 'prefectural_associatio_22' => 'string', 'prefectural_associatio_23' => 'string', 'prefectural_associatio_24' => 'string', 'prefectural_associatio_25' => 'string', 'prefectural_associatio_26' => 'string', 'prefectural_associatio_27' => 'string', 'prefectural_associatio_28' => 'string', 'prefectural_associatio_29' => 'string', 'prefectural_associatio_3' => 'string', 'prefectural_associatio_30' => 'string', 'prefectural_associatio_31' => 'string', 'prefectural_associatio_32' => 'string', 'prefectural_associatio_33' => 'string', 'prefectural_associatio_34' => 'string', 'prefectural_associatio_35' => 'string', 'prefectural_associatio_36' => 'string', 'prefectural_associatio_37' => 'string', 'prefectural_associatio_38' => 'string', 'prefectural_associatio_39' => 'string', 'prefectural_associatio_4' => 'string', 'prefectural_associatio_40' => 'string', 'prefectural_associatio_41' => 'string', 'prefectural_associatio_42' => 'string', 'prefectural_associatio_43' => 'string', 'prefectural_associatio_44' => 'string', 'prefectural_associatio_45' => 'string', 'prefectural_associatio_46' => 'string', 'prefectural_associatio_47' => 'string', 'prefectural_associatio_5' => 'string', 'prefectural_associatio_6' => 'string', 'prefectural_associatio_7' => 'string', 'prefectural_associatio_8' => 'string', 'prefectural_associatio_9' => 'string', 'prefectural_associations_status' => 'string', 'prefectural_chapters' => 'string', 'purchase_of_training_textbooks_1' => 'string', 'purchase_of_training_textbooks_2' => 'string', 'purchase_of_training_textbooks_3' => 'string', 'qualifications_licenses_1' => 'string', 'qualifications_licenses_10' => 'string', 'qualifications_licenses_11' => 'string', 'qualifications_licenses_12' => 'string', 'qualifications_licenses_13' => 'string', 'qualifications_licenses_14' => 'string', 'qualifications_licenses_15' => 'string', 'qualifications_licenses_16' => 'string', 'qualifications_licenses_17' => 'string', 'qualifications_licenses_18' => 'string', 'qualifications_licenses_19' => 'string', 'qualifications_licenses_2' => 'string', 'qualifications_licenses_20' => 'string', 'qualifications_licenses_21' => 'string', 'qualifications_licenses_22' => 'string', 'qualifications_licenses_3' => 'string', 'qualifications_licenses_4' => 'string', 'qualifications_licenses_5' => 'string', 'qualifications_licenses_6' => 'string', 'qualifications_licenses_7' => 'string', 'qualifications_licenses_8' => 'string', 'reason' => 'string', 'reasonable_accommodation' => 'string', 'registration_date' => 'datetime', 'reinstatement_year' => 'string', 'remarks' => 'string', 'renewal_training_course_extension_status' => 'string', 'renewal_training_course_extension_year' => 'string', 'role_1' => 'string', 'role_10' => 'string', 'role_11' => 'string', 'role_12' => 'string', 'role_13' => 'string', 'role_14' => 'string', 'role_15' => 'string', 'role_16' => 'string', 'role_17' => 'string', 'role_18' => 'string', 'role_19' => 'string', 'role_2' => 'string', 'role_20' => 'string', 'role_21' => 'string', 'role_22' => 'string', 'role_23' => 'string', 'role_24' => 'string', 'role_25' => 'string', 'role_26' => 'string', 'role_27' => 'string', 'role_28' => 'string', 'role_29' => 'string', 'role_3' => 'string', 'role_30' => 'string', 'role_31' => 'string', 'role_32' => 'string', 'role_33' => 'string', 'role_34' => 'string', 'role_35' => 'string', 'role_36' => 'string', 'role_37' => 'string', 'role_38' => 'string', 'role_39' => 'string', 'role_4' => 'string', 'role_40' => 'string', 'role_41' => 'string', 'role_42' => 'string', 'role_43' => 'string', 'role_44' => 'string', 'role_45' => 'string', 'role_46' => 'string', 'role_47' => 'string', 'role_48' => 'string', 'role_49' => 'string', 'role_5' => 'string', 'role_50' => 'string', 'role_51' => 'string', 'role_52' => 'string', 'role_6' => 'string', 'role_7' => 'string', 'role_8' => 'string', 'role_9' => 'string', 'scheduled_reinstatement_year' => 'string', 'school_name' => 'string', 'send_materials_to' => 'string', 'sex' => 'string', 'sex_remarks' => 'string', 'sicial_worker_obtain_annual' => 'string', 'social_worker_certification' => 'string', 'status' => 'string', 'training_accreditation_certification_status' => 'string', 'training_accreditation_certification_year' => 'string', 'training_individual_form' => 'string', 'users_id' => 'int', 'withdrawal_date' => 'string', 'work_type_1' => 'string', 'work_type_2' => 'string', 'work_type_3' => 'string', 'work_type_4' => 'string', 'absence_year' => 'string', 'account_transfer_registration_status' => 'string', 'approval_date' => 'string', 'attribute_1' => 'string', 'attribute_2' => 'string', 'attribute_3' => 'string', 'attribute_4' => 'string', 'attribute_5' => 'string', 'attribute_6' => 'string', 'attribute_7' => 'string', 'attribute_8' => 'string', 'authorized_individual_form' => 'string', 'birth_date' => 'string', 'branch_general_meeting' => 'string', 'call_to_acceptable' => 'string', 'certification_number' => 'string', 'certification_year' => 'string', 'certified_svr_registration' => 'string', 'certified_svr_registration_no' => 'string', 'clover_affiliated_address' => 'string', 'clover_affiliated_mail_status' => 'string', 'clover_family_1' => 'string', 'clover_family_2' => 'string', 'clover_family_3' => 'string', 'clover_family_4' => 'string', 'clover_family_5' => 'string', 'clover_family_6' => 'string', 'clover_family_7' => 'string', 'clover_family_8' => 'string', 'clover_home_email' => 'string', 'clover_individual_important_contact_column' => 'string', 'clover_mail_etc' => 'string', 'clover_mailing_list_registration' => 'string', 'clover_registration' => 'string', 'clover_registration_fee_paid' => 'string', 'clover_registration_year' => 'string', 'continuing_training_attendance_cycle' => 'string', 'core_training_status' => 'string', 'core_training_year' => 'string', 'delivery_suspension' => 'string', 'email' => 'string', 'employer_type_1' => 'string', 'employer_type_2' => 'string', 'employer_type_3' => 'string', 'employer_type_4' => 'string', 'employment' => 'string', 'etc_mailing_list_registration' => 'string', 'examination_route' => 'string', 'family_register' => 'string', 'free_text_1' => 'string', 'free_text_2' => 'string', 'free_text_3' => 'string', 'graduation_date' => 'string', 'group_training_participation' => 'string', 'home_address' => 'string', 'home_cities' => 'string', 'home_fax_number' => 'string', 'home_mailing_list_registration' => 'string', 'home_name' => 'string', 'home_postal_code' => 'string', 'home_prefecture' => 'string', 'home_telphone_number' => 'string', 'how_pay_registration_fee' => 'string', 'information_at_the_time_of_mailing' => 'string', 'intention_accept_appointment' => 'string', 'kana1' => 'string', 'kana2' => 'string', 'last_academic_background' => 'string', 'login_id' => 'string', 'management_entity' => 'string', 'member_id' => 'string', 'membership_fee' => 'string', 'membership_type' => 'string', 'mental_health_worker_registration_number' => 'string', 'mobile' => 'string', 'mypage_contact_section_1' => 'string', 'mypage_contact_section_2' => 'string', 'name1' => 'string', 'name2' => 'string', 'need_attend_group_training_within_cycle' => 'string', 'newsletter' => 'string', 'next_scheduled_account_transfer_date' => 'string', 'office_address' => 'string', 'office_availability' => 'string', 'office_cities' => 'string', 'office_extension_number' => 'string', 'office_fax_number' => 'string', 'office_management_memo_1' => 'string', 'office_management_memo_2' => 'string', 'office_management_memo_3' => 'string', 'office_management_memo_4' => 'string', 'office_management_memo_5' => 'string', 'office_management_memo_6' => 'string', 'office_management_memo_7' => 'string', 'office_management_memo_8' => 'string', 'office_management_memo_9' => 'string', 'office_name' => 'string', 'office_postal_code' => 'string', 'office_prefecture' => 'string', 'office_telephone_number' => 'string', 'partner_registration' => 'string', 'position' => 'string', 'prefectural_associatio_1' => 'string', 'prefectural_associatio_10' => 'string', 'prefectural_associatio_11' => 'string', 'prefectural_associatio_12' => 'string', 'prefectural_associatio_13' => 'string', 'prefectural_associatio_14' => 'string', 'prefectural_associatio_15' => 'string', 'prefectural_associatio_16' => 'string', 'prefectural_associatio_17' => 'string', 'prefectural_associatio_18' => 'string', 'prefectural_associatio_19' => 'string', 'prefectural_associatio_2' => 'string', 'prefectural_associatio_20' => 'string', 'prefectural_associatio_21' => 'string', 'prefectural_associatio_22' => 'string', 'prefectural_associatio_23' => 'string', 'prefectural_associatio_24' => 'string', 'prefectural_associatio_25' => 'string', 'prefectural_associatio_26' => 'string', 'prefectural_associatio_27' => 'string', 'prefectural_associatio_28' => 'string', 'prefectural_associatio_29' => 'string', 'prefectural_associatio_3' => 'string', 'prefectural_associatio_30' => 'string', 'prefectural_associatio_31' => 'string', 'prefectural_associatio_32' => 'string', 'prefectural_associatio_33' => 'string', 'prefectural_associatio_34' => 'string', 'prefectural_associatio_35' => 'string', 'prefectural_associatio_36' => 'string', 'prefectural_associatio_37' => 'string', 'prefectural_associatio_38' => 'string', 'prefectural_associatio_39' => 'string', 'prefectural_associatio_4' => 'string', 'prefectural_associatio_40' => 'string', 'prefectural_associatio_41' => 'string', 'prefectural_associatio_42' => 'string', 'prefectural_associatio_43' => 'string', 'prefectural_associatio_44' => 'string', 'prefectural_associatio_45' => 'string', 'prefectural_associatio_46' => 'string', 'prefectural_associatio_47' => 'string', 'prefectural_associatio_5' => 'string', 'prefectural_associatio_6' => 'string', 'prefectural_associatio_7' => 'string', 'prefectural_associatio_8' => 'string', 'prefectural_associatio_9' => 'string', 'prefectural_associations_status' => 'string', 'prefectural_chapters' => 'string', 'purchase_of_training_textbooks_1' => 'string', 'purchase_of_training_textbooks_2' => 'string', 'purchase_of_training_textbooks_3' => 'string', 'qualifications_licenses_1' => 'string', 'qualifications_licenses_10' => 'string', 'qualifications_licenses_11' => 'string', 'qualifications_licenses_12' => 'string', 'qualifications_licenses_13' => 'string', 'qualifications_licenses_14' => 'string', 'qualifications_licenses_15' => 'string', 'qualifications_licenses_16' => 'string', 'qualifications_licenses_17' => 'string', 'qualifications_licenses_18' => 'string', 'qualifications_licenses_19' => 'string', 'qualifications_licenses_2' => 'string', 'qualifications_licenses_20' => 'string', 'qualifications_licenses_21' => 'string', 'qualifications_licenses_22' => 'string', 'qualifications_licenses_3' => 'string', 'qualifications_licenses_4' => 'string', 'qualifications_licenses_5' => 'string', 'qualifications_licenses_6' => 'string', 'qualifications_licenses_7' => 'string', 'qualifications_licenses_8' => 'string', 'reason' => 'string', 'reasonable_accommodation' => 'string', 'registration_date' => 'datetime', 'reinstatement_year' => 'string', 'remarks' => 'string', 'renewal_training_course_extension_status' => 'string', 'renewal_training_course_extension_year' => 'string', 'role_1' => 'string', 'role_10' => 'string', 'role_11' => 'string', 'role_12' => 'string', 'role_13' => 'string', 'role_14' => 'string', 'role_15' => 'string', 'role_16' => 'string', 'role_17' => 'string', 'role_18' => 'string', 'role_19' => 'string', 'role_2' => 'string', 'role_20' => 'string', 'role_21' => 'string', 'role_22' => 'string', 'role_23' => 'string', 'role_24' => 'string', 'role_25' => 'string', 'role_26' => 'string', 'role_27' => 'string', 'role_28' => 'string', 'role_29' => 'string', 'role_3' => 'string', 'role_30' => 'string', 'role_31' => 'string', 'role_32' => 'string', 'role_33' => 'string', 'role_34' => 'string', 'role_35' => 'string', 'role_36' => 'string', 'role_37' => 'string', 'role_38' => 'string', 'role_39' => 'string', 'role_4' => 'string', 'role_40' => 'string', 'role_41' => 'string', 'role_42' => 'string', 'role_43' => 'string', 'role_44' => 'string', 'role_45' => 'string', 'role_46' => 'string', 'role_47' => 'string', 'role_48' => 'string', 'role_49' => 'string', 'role_5' => 'string', 'role_50' => 'string', 'role_51' => 'string', 'role_52' => 'string', 'role_6' => 'string', 'role_7' => 'string', 'role_8' => 'string', 'role_9' => 'string', 'scheduled_reinstatement_year' => 'string', 'school_name' => 'string', 'send_materials_to' => 'string', 'sex' => 'string', 'sex_remarks' => 'string', 'sicial_worker_obtain_annual' => 'string', 'social_worker_certification' => 'string', 'status' => 'string', 'training_accreditation_certification_status' => 'string', 'training_accreditation_certification_year' => 'string', 'training_individual_form' => 'string', 'users_id' => 'int', 'withdrawal_date' => 'string', 'work_type_1' => 'string', 'work_type_2' => 'string', 'work_type_3' => 'string', 'work_type_4' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'registration_date', 'registration_date'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
    public function sakuraMember(){
        return $this->hasOne(SakurasetManage::class,'member_id','login_id');
    }
    public function sakuraReviewer(){
        return $this->hasOne(SakurasetManage::class,'reviewer_id','login_id');
    }
}
