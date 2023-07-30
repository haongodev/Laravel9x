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
    public function getReviewer($member){
        return $this->model->with('reviewer_member:users_id,member_id,email,name1,name2')->where('member_id',$member)->first()->toArray()['reviewer_member'];
    }
    public function getSheetInfoByReviewerId($inst,$reviewerId,$kind){
        $model = $inst->model->select('id','file_name','member_id')->where([['member_id',$reviewerId],['share_flg',1]])->whereNull('delete_date');
        if($kind == 'only'){
            $model = $model->first();
        }else{
            $model = $model->get();
        }
        return $model;
    }
}
