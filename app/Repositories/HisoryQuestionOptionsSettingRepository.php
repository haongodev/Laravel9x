<?php

namespace App\Repositories;


use App\Models\HisQuestionOptionsSettings;
use Illuminate\Support\Facades\DB;

class HisoryQuestionOptionsSettingRepository
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

}
