<?php

namespace App\Services;

use App\Repositories\UserAddInfoRepository;
use App\Repositories\UserRepository;
use App\Repositories\ManagedUsersAddInfoRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MemberService
{
    /**
     * @var UserAddInfoRepository
     */
    protected $userAddInfoRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;
    protected $managedUsersAddInfoRepository;


    /**
     * MemberService constructor.
     * @param UserAddInfoRepository $userAddInfoRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserAddInfoRepository $userAddInfoRepository,
        UserRepository $userRepository,
        ManagedUsersAddInfoRepository $managedUsersAddInfoRepository
    )
    {
        $this->userAddInfoRepository = $userAddInfoRepository;
        $this->userRepository = $userRepository;
        $this->managedUsersAddInfoRepository = $managedUsersAddInfoRepository;
    }

    public function getByCondition($condition = [])
    {
        return $this->userAddInfoRepository->getByCondition($condition);
    }

    public function updatePassWord($userId = 0, $password = '')
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($password);
            $this->userRepository->updateById($userId, $data);
            DB::commit();
            return true;
        } catch (QueryException $exc) {
            DB::rollBack();
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    public function getByLoginId($loginId = '')
    {
        return $this->userAddInfoRepository->getByLoginId($loginId);
    }

    public function getUserManage($condition = [])
    {
        return $this->managedUsersAddInfoRepository->getUserManage($condition);
    }
}

