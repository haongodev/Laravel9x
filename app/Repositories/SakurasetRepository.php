<?php

namespace App\Repositories;


use App\Models\SakurasetManage;
use Illuminate\Support\Facades\DB;

class SakurasetRepository
{
    protected $model;

    public function __construct(SakurasetManage $model)
    {
        $this->model = $model;
    }
    public function getByLoggedId($where,$type,$with){
        $result = $this->model;
        if($with){
            $result = $result->with($with);
        }
        $result = $result->where($where[0],$where[1]);
        if(!$type){
            return $result->first();
        }else{
            return $result->orderBy('registration_date','ASC')->get();
        }
    }
}
