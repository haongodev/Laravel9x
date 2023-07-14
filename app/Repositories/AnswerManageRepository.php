<?php

namespace App\Repositories;


use App\Models\AnswerManage;
use Illuminate\Support\Facades\DB;

class AnswerManageRepository
{
    protected $model;

    public function __construct(AnswerManage $model)
    {
        $this->model = $model;
    }

    public function getRegistrationYearByTypeNativeId($typeNativeId = 0)
    {
        $memberId = auth()->user()->id ?? '';
        return $this->model
            ->join('answer_info', function ($q) {
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })->where('member_id',$memberId)
            ->where('answer_manage.type_native_id',$typeNativeId)
            ->groupBy('registration_year')->pluck('registration_year');
    }

    public function getLastId()
    {
        return $this->model->orderBy('id','DESC')->get()->pluck('id')->first();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }
}
