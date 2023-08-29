<?php

namespace App\Repositories;


use App\Models\HisQuestionSettings;
use Illuminate\Support\Facades\DB;

class HistoryQuestionSettingRepository
{
    protected $model;

    public function __construct(HisQuestionSettings $model)
    {
        $this->model = $model;
    }

    public function store($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    public function getByOriginalQuestionIds($originalQuestionIds = 0)
    {
        return $this->model->whereIn('id', $originalQuestionIds)->get();
    }

    public function getByParentQuestionOptionId($parentId)
    {
        return $this->model->where('parent_question_option_id', $parentId)->get()->first();
    }

    public function getByIds($ids = [])
    {

        return $this->model->whereIn('id', $ids)->get()->keyBy('id');

    }
}
