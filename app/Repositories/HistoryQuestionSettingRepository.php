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

    public function store($data)
    {
        return $this->model->updateOrCreate($data);
    }

}
