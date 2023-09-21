<?php

use App\Models\AnswerInfo;
use App\Models\UsersAddInfo;
use App\Models\SakurasetManage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

if (!function_exists('answerInfoPattern')) {
    function answerInfoPattern()
    {
        $currentYear = date('m') > 3 ? date('Y') : date('Y', strtotime('-1 year'));
        $memberId = auth()->user()->id;
        $answerInfoData = AnswerInfo::select([
            'answer_info.type_native_id',
            DB::raw('sum(score) as score_total')
        ])
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('answer_manage.member_id', $memberId)
            ->whereIn('answer_info.type_native_id', [0, 1, 2])
            ->where('answer_manage.registration_year', $currentYear)
            ->groupBy('answer_info.type_native_id')->get();
        $data = [];
        foreach ($answerInfoData as $value) {
            $data[$value->type_native_id]['score_total'] = $value->score_total;
        }
        return $data;
    }

}

if (!function_exists('getCertificationYear')) {
    function getCertificationYear()
    {
        if (auth()->user()->user_add_info->training_accreditation_certification_status == '認定精神保健福祉士'
            || auth()->user()->user_add_info->training_accreditation_certification_status == '研修認精神定保健福祉士'
        ){
            return auth()->user()->user_add_info->training_accreditation_certification_year ?? 0;
        }
        return 0;
    }

}

if (!function_exists('scheduledDate')) {
    function scheduledDate()
    {
        $memberId = auth()->user()->id;
        $scheduled_date = SakurasetManage::where('member_id', $memberId)->pluck('scheduled_date')->first();
        return Carbon::parse($scheduled_date)->format('Y年 m月 d日');
    }

}

if (!function_exists('groupClassQuestionOption')) {
    function groupClassQuestionOption($questionOptionData)
    {
        $data = [];
        foreach ($questionOptionData as $key => $questionOption) {
            $data[$questionOption->class_name][] = $questionOption;
        }
        return $data;
    }
}

if (!function_exists('forgetSessionCreditRegistry')) {
    function forgetSessionCreditRegistry()
    {
        Session::forget('show_popup_confirm');
        Session::forget('popup_confirm');
        Session::forget('question_confirm');
        Session::forget('question_option_confirm');
        Session::forget('answer_info_data');

    }
}

if (!function_exists('rangeYear')) {
    function rangeYear()
    {
        $data = [];
        for ($i = date('Y'); $i>=1970; $i--){
            $data[$i] = $i;
        }
        return $data;

    }
}
