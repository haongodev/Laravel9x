<?php

namespace App\Repositories;


use App\Models\QuestionSettings;
use Illuminate\Support\Facades\DB;

class QuestionSettingRepository
{
    protected $model;

    public function __construct(QuestionSettings $model)
    {
        $this->model = $model;
    }

    public function getByQuestionId($questionId = 0)
    {
        return $this->model->where('question_id', $questionId)->where('level', 1)->get();
    }

    public function getById($id = 0)
    {
        return $this->model->where('id',$id)->get()->first();
    }

    public function getByParentQuestionOptionId($parentId = 0)
    {
        return $this->model->where('parent_question_option_id',$parentId)->get()->first();
    }

}
