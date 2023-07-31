<?php

namespace App\Repositories;


use App\Models\UsersAddInfo;
use Illuminate\Support\Facades\DB;

class UserAddInfoRepository
{
    protected $model;

    public function __construct(UsersAddInfo $model)
    {
        $this->model = $model;
    }

    public function getByUserId($userId = 0,$select)
    {
        return $this->model->select($select)->where('users_id',$userId)->first();
    }
}
