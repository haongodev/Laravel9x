<?php

namespace App\Services;

use App\Repositories\UserAddInfoRepository;
use App\Repositories\UserRepository;
use App\Repositories\ManagedUsersAddInfoRepository;
use App\Repositories\AnswerManageRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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

    /**
     * @var ManagedUsersAddInfoRepository
     */
    protected $managedUsersAddInfoRepository;

    /**
     * @var AnswerManageRepository
     */
    protected $answerManageRepository;
    
    /**
     * MemberService constructor.
     * @param UserAddInfoRepository $userAddInfoRepository
     * @param UserRepository $userRepository
     * @param ManagedUsersAddInfoRepository $managedUsersAddInfoRepository
     */
    public function __construct(
        UserAddInfoRepository $userAddInfoRepository,
        UserRepository $userRepository,
        ManagedUsersAddInfoRepository $managedUsersAddInfoRepository,
        AnswerManageRepository $answerManageRepository
    )
    {
        $this->userAddInfoRepository = $userAddInfoRepository;
        $this->userRepository = $userRepository;
        $this->managedUsersAddInfoRepository = $managedUsersAddInfoRepository;
        $this->answerManageRepository = $answerManageRepository;
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

    public function getUserManageByLoginId($loginId = '')
    {
        return $this->managedUsersAddInfoRepository->getUserManageByLoginId($loginId);
    }

    public function getUserManageByUserId($userId = '')
    {
        return $this->managedUsersAddInfoRepository->getUserManageByUserId($userId);
    }

    public function storeUserManage($data = [])
    {
        DB::beginTransaction();
        try {
            if (!empty($data['password']) && $data['password'] != config('constants.passwordDefault')) {
                $dataUser['password'] = Hash::make($data['password']);
            }
            $dataUser['name'] = $data['name'];
            $dataUser['class'] = 1;
            $dataUser['active_flg'] = 1;
            $dataUser['id'] = (string) Str::uuid();
            $this->userRepository->storeUser($dataUser);
            
            $dataUserInfo['id'] = (string) Str::uuid();
            $dataUserInfo['users_id'] = $dataUser['id'];
            $dataUserInfo['login_id'] = $data['login_id'];
            $dataUserInfo['manager_class'] = $data['manager_class'];
            $dataUserInfo['attribute'] = $data['attribute'];
            $this->managedUsersAddInfoRepository->storeUser($dataUserInfo);
            DB::commit();
            return true;
        } catch (QueryException $exc) {
            DB::rollBack();
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    public function updateUserManage($userId = 0, $data = [])
    {
        DB::beginTransaction();
        try {
            if (!empty($data['password']) && $data['password'] != config('constants.passwordDefault')) {
                $dataUser['password'] = Hash::make($data['password']);
            }
            $dataUser['name'] = $data['name'];
            $this->userRepository->updateById($userId, $dataUser);

            $dataUserInfo['login_id'] = $data['login_id'];
            $dataUserInfo['manager_class'] = $data['manager_class'];
            $dataUserInfo['attribute'] = $data['attribute'];
            $this->managedUsersAddInfoRepository->updateByUserId($userId, $dataUserInfo);
            DB::commit();
            return true;
        } catch (QueryException $exc) {
            DB::rollBack();
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    public function deleteUserManageByUserId($userId = 0)
    {
        return $this->managedUsersAddInfoRepository->deleteByUserId($userId);
    }
    public function getPercentUse(){
        $totalNum = $this->userRepository->countUserUse();
        $activeNum = $this->answerManageRepository->countAnswer();
        $result = ($activeNum / $totalNum) * 100;
        return number_format($result,1);
    }

}

