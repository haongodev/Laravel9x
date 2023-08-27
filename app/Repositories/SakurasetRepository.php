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
    public function getSheetInfoByReviewerId($inst,$reviewerId,$kind,$select){
        $where = [
            ['share_flg',1]
        ];
        if(is_array($reviewerId)){
            foreach($reviewerId as $key => $value){
                array_push($where,[$key,$value]);
            }
        }else{
            array_push($where,['member_id',$reviewerId]);
        }
        $model = $inst->model->select($select)->where($where)->whereNull('delete_date');
        if($kind == 'only'){
            $model = $model->first();
        }else{
            $model = $model->orderBy('class','ASC')->get();
        }
        return $model;
    }
    public function createBackupData($inst,$namebk,$namedis,$memberId,$class){
        $arrData = [
            'file_name' => $namebk,
            'share_flg' => 0,
            'member_id' => $memberId,
            'display_name' => $namedis,
        ];
        if($class !== null){
            $arrData['class'] = $class;
        }
        $inst->model->create($arrData);
    }
    public function updateSchedule($date,$memberid){
        return $this->model->where([['member_id',$memberid],['confirmation_flg', 'false']])->update([
            'scheduled_date' => $date
        ]);
    }
}
