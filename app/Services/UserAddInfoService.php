<?php

namespace App\Services;

use App\Repositories\UserAddInfoRepository;

class UserAddInfoService
{
    /**
     * @var UserAddInfoRepository
     */
    protected $userAddInfoRepository;

    /**
     * UserService constructor.
     * @param UserAddInfoRepository $userAddInfoRepository
     */
    public function __construct(UserAddInfoRepository $userAddInfoRepository)
    {
        $this->userAddInfoRepository = $userAddInfoRepository;
    }

    public function getByUserId($userId = 0,$select)
    {
        return $this->userAddInfoRepository->getByUserId($userId,$select);
    }
    public function getMemberToReview($data){
        return $this->userAddInfoRepository->getMemberToReview($data);
    }
}
