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

    public function store($data)
    {
        return $this->model->updateOrCreate($data);
    }

    public function getByIds($ids = [])
    {
        return $this->model->whereIn('id',$ids)->get()->keyBy('id');
    }
}
