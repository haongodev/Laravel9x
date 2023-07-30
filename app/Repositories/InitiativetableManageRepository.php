<?php

namespace App\Repositories;


use App\Models\InitiativetableManage;
use Illuminate\Support\Facades\DB;

class InitiativetableManageRepository
{
    public $model;

    public function __construct(InitiativetableManage $model)
    {
        $this->model = $model;
    }
}
