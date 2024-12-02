<?php
namespace App\Repositories;


use App\Models\ManagedUsersAddInfo;
use Illuminate\Support\Facades\DB;

class ManagedUsersAddInfoRepository
{
    protected $model;

    public function __construct(ManagedUsersAddInfo $model)
    {
        $this->model = $model;
    }
    public function getUserManage($condition = [])
    {
        $loginId = $condition['login_id'] ?? '';
        $name = $condition['name'] ?? '';
        $attribute = $condition['attribute'] ?? -1;
        return $this->model
            ->select(
                'users.name',
                'users.id',
                'managed_users_add_info.login_id',
                'managed_users_add_info.manager_class',
                'managed_users_add_info.attribute',
            )
            ->join('users', function ($q) {
                $q->on('users.id', '=', 'managed_users_add_info.users_id');
            })
            ->where('users.class', 1)
            ->when(!empty($loginId), function ($query) use ($loginId) {
                return $query->where('managed_users_add_info.login_id', $loginId);
            })
            ->when(!empty($name), function ($query) use ($name) {
                $name = str_replace('　', '', $name);
                $name = str_replace(' ', '', $name);
                return $query->whereRaw("REGEXP_REPLACE(users.name, '( |　)', '')='$name'");
            })
            ->when(isset($attribute) && $attribute > -1, function ($query) use ($attribute) {
                return $query->where('managed_users_add_info.attribute', $attribute);
            });
    }

    public function getUserManageByLoginId($loginId = '')
    {
        return $this->model
            ->select(
                'users.name',
                'users.id',
                'managed_users_add_info.login_id',
                'managed_users_add_info.manager_class',
                'managed_users_add_info.attribute',
            )
            ->join('users', function ($q) {
                $q->on('users.id', '=', 'managed_users_add_info.users_id');
            })
            ->where('managed_users_add_info.login_id', $loginId)->get()->first();;
    }

    public function getUserManageByUserId($userId = '')
    {
        return $this->model
            ->select(
                'users.name',
                'users.id',
                'managed_users_add_info.login_id',
                'managed_users_add_info.manager_class',
                'managed_users_add_info.attribute',
            )
            ->join('users', function ($q) {
                $q->on('users.id', '=', 'managed_users_add_info.users_id');
            })
            ->where('users.id', $userId)->get()->first();;
    }

    public function updateByUserId($userId, $data)
    {
        return $this->model->where('users_id', $userId)->update($data);
    }

    public function storeUser($data)
    {
        return $this->model->create($data);
    }

    public function deleteByUserId($userId)
    {
        return $this->model->where('users_id', $userId)->delete();
    }
}
