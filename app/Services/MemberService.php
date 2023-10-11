<?php

namespace App\Services;

use App\Repositories\UserAddInfoRepository;

class MemberService
{
    protected $userAddInfoRepository;

    public function __construct(UserAddInfoRepository $userAddInfoRepository)
    {
        $this->userAddInfoRepository = $userAddInfoRepository;
    }

    public function getByCondition($condition = [])
    {
        return $this->userAddInfoRepository->getByCondition($condition);
    }
}

