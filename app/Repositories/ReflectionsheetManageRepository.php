<?php

namespace App\Repositories;


use App\Models\ReflectionsheetManage;
use Illuminate\Support\Facades\DB;

class ReflectionsheetManageRepository
{
    public $model;

    public function __construct(ReflectionsheetManage $model)
    {
        $this->model = $model;
    }
}
