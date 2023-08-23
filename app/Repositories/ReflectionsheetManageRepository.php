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

    public function insertGetId($data = [])
    {
        return $this->model->insertGetId($data);
    }

    public function getById($id=0)
    {
        return $this->model->where('id',$id)->get()->first();
    }

    public function getByUserId($userId = 0)
    {
        return $this->model->where('member_id',$userId)->get();
    }

    public function updateByMemberId($memberId = 0, $data = [])
    {
        return $this->model->where('member_id',$memberId)->update($data);
    }

    public function update($id = 0, $data = [])
    {
        return $this->model->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->where('id',$id)->delete();
    }
}
