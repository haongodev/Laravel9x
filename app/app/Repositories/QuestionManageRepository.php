<?php

namespace App\Repositories;


use App\Models\QuestionManage;
use Illuminate\Support\Facades\DB;

class QuestionManageRepository
{
    protected $model;

    public function __construct(QuestionManage $model)
    {
        $this->model = $model;
    }

    public function getByTypeNativeId($typeNativeId = 0)
    {
        return $this->model->where('type_native_id',$typeNativeId)->where('active_flg',true)->get();
    }

}
