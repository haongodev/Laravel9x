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

    public function insertGetId($data){
        return $this->model->insertGetId($data);
    }

    public function getByUserId($userId)
    {
        return $this->model->where('member_id',$userId)->get();
    }

    public function update($id, $data)
    {
        return $this->model->where('id',$id)->update($data);
    }

    public function updateByMemberId($memberId, $data)
    {
        return $this->model->where('member_id',$memberId)->update($data);
    }

    public function destroy($id = 0)
    {
        return $this->model->where('id',$id)->delete();
    }

    public function getById($id = 0)
    {
        return $this->model->where('id',$id)->get()->first();
    }

    public function getAllTypeFileUploadByMemberId($loginId)
    {
         $faceSheetManage = DB::table("facesheet_manage")
             ->select(
                 'member_id',
                 'file_name',
                 'update_date',
                 DB::raw('0 AS file_type' )
             )
             ->where('member_id',$loginId);
        $reflectionsheetManage = DB::table("reflectionsheet_manage")
            ->select(
                'member_id',
                'file_name',
                'update_date',
                DB::raw('CASE WHEN `class`= 0 THEN 1 WHEN `class` = 1 THEN 2 WHEN `class` =2 THEN 3 END AS file_type')
            )
            ->where('member_id',$loginId);
        $initiativetableManage = DB::table("initiativetable_manage")
            ->select(
                'member_id',
                'file_name',
                'update_date',
                DB::raw('4 AS file_type' )
            )
            ->where('member_id',$loginId);
        return $faceSheetManage->union($reflectionsheetManage)->union($initiativetableManage)->orderBy('update_date','DESC');
    }
}
