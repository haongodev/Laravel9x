<?php

namespace App\Repositories;


use App\Models\FacesheetManage;
use Illuminate\Support\Facades\DB;

class FacesheetManageRepository
{
    public $model;

    public function __construct(FacesheetManage $model)
    {
        $this->model = $model;
    }
}
