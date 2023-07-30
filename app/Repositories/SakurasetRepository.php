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
    public function getByLoggedId($where,$with){
        $result = $this->model;
        if($with){
            $result = $result->with($with);
        }
        return $result->where($where[0],$where[1])->first();
    }
    public function updateSakura($data,$where){
        try {
            $model = $this->model->where($where)->first();
            if ($model) {
                $model->update($data);
                return $model;
            } else {
                return null;
            }
        } catch (QueryException $exc) {
            Log::error($exc->getMessage(), $exc->getTrace());
            return null;
        }
    }
}
