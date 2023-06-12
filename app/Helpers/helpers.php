<?php

use App\Models\AnswerInfo;
use App\Models\UsersAddInfo;
use App\Models\SakurasetManage;
use Illuminate\Support\Facades\DB;

if (!function_exists('answerInfoPattern')) {
    function answerInfoPattern()
    {
        $currentYear = date('m') > 3 ? date('Y') : date('Y-m-d', strtotime('-1 year'));
        $memberId = auth()->user()->id;
        $answerInfoData = AnswerInfo::select([
            'answer_info.type_native_id',
            DB::raw('sum(score) as score_total')
        ])
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('answer_manage.member_id',$memberId)
            ->whereIn('answer_info.type_native_id', [0, 1, 2])
            ->where('answer_manage.registration_year',$currentYear)
            ->groupBy('answer_info.type_native_id')->get();
        $data = [];
        foreach ($answerInfoData as $value){
            $data[$value->type_native_id] = $value->score_total;
        }
        return $data;
    }

}

if (!function_exists('getCertificationYear')) {
    function getCertificationYear()
    {
        $memberId = auth()->user()->id;
        $certificationYearData = UsersAddInfo::where('member_id', $memberId)->pluck('certification_year')->first();
        $getCertificationYear = date('m', strtotime($certificationYearData)) > 3
            ? date('Y', strtotime($certificationYearData)) + 4
            : date('Y', strtotime($certificationYearData)) + 3;
        return $getCertificationYear;
    }

}

if (!function_exists('scheduledDate')) {
    function scheduledDate()
    {
        $memberId = auth()->user()->id;
        return SakurasetManage::where('member_id',$memberId)->pluck('scheduled_date')->first();
    }

}
