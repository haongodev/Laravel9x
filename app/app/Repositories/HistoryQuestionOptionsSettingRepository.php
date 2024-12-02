<?php

namespace App\Repositories;


use App\Models\HisQuestionOptionsSettings;
use Illuminate\Support\Facades\DB;

class HistoryQuestionOptionsSettingRepository
{
    protected $model;

    public function __construct(HisQuestionOptionsSettings $model)
    {
        $this->model = $model;
    }

    public function store($condition,$data)
    {
        return $this->model->updateOrCreate($condition,$data);
    }

    public function getByIds($ids = [])
    {
        return $this->model->whereIn('id',$ids)->get()->keyBy('id');
    }
    public function getByQuestionId($questionId = 0)
    {
        return $this->model->where('question_id',$questionId)->get();
    }
    public function delByAnsManageId($ans_manage_id = 0)
    {
        return $this->model->where('ans_manage_id',$ans_manage_id)->delete();
    }
}
