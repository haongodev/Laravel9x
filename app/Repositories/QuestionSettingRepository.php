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

    public function getByQuestionId($questionId = 0, $allLevel = 0)
    {
        return $this->model->where('question_id', $questionId)
            ->when(empty($allLevel), function ($query)  {
                return $query->where('level', 1);
            })->get();
    }

    public function getChildByQuestionId($questionId = 0)
    {
        return $this->model->where('question_id', $questionId)->where('level',2)->where('parent_question_id','<>', 0)->whereNull('parent_question_option_id')->get();
    }
    public function getById($id = 0)
    {
        return $this->model->where('id',$id)->get()->first();
    }

    public function getByParentQuestionOptionId($parentId = 0)
    {
        return $this->model->where('parent_question_option_id',$parentId)->get()->first();
    }

    public function getByIds(array $ids = [])
    {
        return $this->model->whereIn('id',$ids)->orderByRaw(DB::raw("FIELD(id, " . implode(',', $ids) . ")"))->get()->keyBy('id');
    }

}
