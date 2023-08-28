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

    public function insertGetId($data){
        return $this->model->insertGetId($data);
    }
    public function getById($id = 0)
    {
        return $this->model->where('id',$id)->get()->first();
    }
    public function getByUserId($userId)
    {
        return $this->model->where('member_id',$userId)->get();
    }
    public function update($id, $data)
    {
        return $this->model->where('id',$id)->update($data);
    }
    public function destroy($id = 0)
    {
        return $this->model->where('id',$id)->delete();
    }
    public function updateByMemberId($memberId, $data)
    {
        return $this->model->where('member_id',$memberId)->update($data);
    }
}
