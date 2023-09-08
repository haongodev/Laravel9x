<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getByMemberId($memberId = 0)
    {
        return $this->userRepository->getByMemberId($memberId);
    }

    public function getByLoginId($loginId = 0)
    {
        return $this->userRepository->getByLoginId();
    }
}
