<?php

namespace App\Repositories;


use App\Models\AnswerInfo;
use Illuminate\Support\Facades\DB;

class AnswerInfoRepository
{
    protected $model;

    public function __construct(AnswerInfo $model)
    {
        $this->model = $model;
    }

    public function getPattern()
    {

        $currentYear = date('m') > 3 ? date('Y') : date('Y-m-d', strtotime('+1 year'));
        $memberId = auth()->user()->id;
        $answerInfo = $this->model->select([
            'type_native_id',
            DB::raw('sum(score) as score_total')
        ])
            ->whereIn('type_native_id', [0, 1, 2])
            ->where('terminal_flg', true)
            ->whereRaw('DATE_FORMAT(registration_date,"%Y") = ' . $currentYear);
        if ($memberId) {

        }
        $answerInfo->groupBy('type_native_id')->get();

    }

    public function getTitle()
    {
        $memberId = auth()->user()->id;
        $currentYear = date('m') > 3 ? date('Y') : date('Y', strtotime('-1 year'));
        return $this->model
            ->select('title')
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('answer_manage.member_id', $memberId)
            ;
    }
}
