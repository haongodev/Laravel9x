<?php

namespace App\Repositories;


use App\Models\QuestionOptionsSettings;
use Illuminate\Support\Facades\DB;

class QuestionOptionSettingRepository
{
    protected $model;

    public function __construct(QuestionOptionsSettings $model)
    {
        $this->model = $model;
    }

    public function getByIds(array $ids = [])
    {
        return $this->model->whereIn('id',$ids)->get()->keyBy('id');
    }

    public function getByQuestionId($questionId = 0)
    {
        return $this->model->where('question_id',$questionId)->get();
    }
}
