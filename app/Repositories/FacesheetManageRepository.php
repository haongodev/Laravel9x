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

    public function store($data){
        return $this->model->create($data);
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
}
