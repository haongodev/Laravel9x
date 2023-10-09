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

    public function getByCondition($condition)
    {
        $loginId = $condition['login_id'] ?? '';
        $name = $condition['name'] ?? '';
        $membershipType = $condition['membership_type'] ?? '';

        return $this->model
            ->select('id','login_id','email','name1','name2','membership_type')
            ->when(!empty($loginId), function ($query) use ($loginId) {
                return $query->where('login_id', $loginId);
            })
            ->when(!empty($name), function ($query) use ($name) {
                $name = str_replace('　','',$name);
                $name = str_replace(' ','',$name);
                return $query->whereRaw('CONCAT(name1,name2)="'.$name.'"');
            })
            ->when(!empty($membershipType), function ($query) use ($membershipType) {
                return $query->where('membership_type', $membershipType);
            })
            ;

    }
}
