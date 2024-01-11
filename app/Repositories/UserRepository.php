<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getByMemberId($memberId = 0)
    {
        return $this->model
            ->join('users_add_info', function ($q) {
                $q->on('users_add_info.users_id', '=', 'users.id');
            })->where('member_id', $memberId)->where('active_flg', true)
            ->get()->first();
    }

    public function getByLoginId($loginId =0)
    {
        return $this->model
            ->join('users_add_info', function ($q) {
                $q->on('users_add_info.users_id', '=', 'users.id');
            })->where('login_id', $loginId)->where('active_flg', true)
            ->get()->first();
    }

    public function updateById($id = '', $data = [])
    {
        return $this->model->where('id', $id)->update($data);
    }
    public function storeUser($data = [])
    {
        return $this->model->create($data);
    }

    public function countUserUse()
    {
        return $this->model->where('class', 0)->whereNot('name','四葉')->count();
    }
}
