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

    public function getTitleByTypeNativeId($typeNativeId = 0)
    {
        $memberId = auth()->user()->id;
        return $this->model
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('member_id', $memberId)
            ->where('answer_info.type_native_id', $typeNativeId)
            ->where('level', 1)
            ->where('registration_year', date('Y'))
            ->groupBy('title')
            ->pluck('title');
    }

    public function searchCredits(array $data = [])
    {
        $registrationYear = $data['registration_year'] ?? '';
        $title = $data['title'] ?? '';
        $typeNativeId = $data['type_native_id'] ?? 0;
        $memberId = auth()->user()->id;

        $answerInfo2 = $this->model
            ->select([
                'answer_manage_id',
                'original_question_id',
                'answer'
            ])
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('member_id', $memberId)
            ->where('answer_info.type_native_id', $typeNativeId)
            ->where('title', '期間')
            ->when(!empty($registrationYear), function ($query) use ($registrationYear) {
                return $query->where('registration_year', $registrationYear);
            });

        $answerInfo1 = $this->model
            ->select([
                'answer_info.answer_manage_id',
                'answer_info.original_question_id',
                DB::raw('answer_info.answer as answer1'),
                DB::raw('answer_info2.answer as answer2'),
            ])
            ->join('answer_manage', function ($q) {
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->joinSub($answerInfo2, 'answer_info2', function ($join)
            {
                $join->on('answer_info.answer_manage_id', '=', 'answer_info2.answer_manage_id');
            })
            ->where('member_id', $memberId)
            ->where('answer_info.type_native_id', $typeNativeId)
            ->where('level', 1)
            ->when(!empty($registrationYear), function ($query) use ($registrationYear) {
                return $query->where('registration_year', $registrationYear);
            })
            ->when(!empty($title), function ($query) use ($title) {
                return $query->where('title', $title);
            });

        return $answerInfo1->get();
    }

    public function store($data)
    {
        return $this->model->insert($data);
    }

    public function getByAnswerManageId($answerManageId = 0)
    {
        return $this->model->where('answer_manage_id', $answerManageId)->get();
    }
}
