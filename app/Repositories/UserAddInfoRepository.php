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

    public function getMemberToReview($data)
    {
      return $this->model
        ->leftJoin('users', 'users.id', '=', 'users_add_info.users_id')
        ->select('users_add_info.users_id','users_add_info.member_id','users_add_info.login_id','users_add_info.email','users_add_info.name1','users_add_info.name2')
        ->where(function ($query) use($data) {
            $query->Where('users_add_info.login_id', $data['login_id'])
                  ->Where('users_add_info.name2', $data['first_name']);
        })
        ->where([['users.active_flg',1],['users.class',0]])
        ->get();
    }
}
