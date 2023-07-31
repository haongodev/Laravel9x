<?php

namespace App\Services;

use App\Repositories\SakurasetRepository;

class SakurasetService
{
    /**
     * @var SakurasetRepository
     */
    protected $sakurasetRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(SakurasetRepository $sakurasetRepository)
    {
        $this->sakurasetRepository = $sakurasetRepository;
    }
    public function getByLoggedId($where,$with = null){
        return $this->sakurasetRepository->getByLoggedId($where,$with);
    }
    public function updateSakura($dataUpdate,$where){
        return $this->sakurasetRepository->updateSakura($dataUpdate,$where);
    }
    public function getReviewerbyMember($member){
        return $this->sakurasetRepository->getReviewer($member);
    }
    public function getFileInfoByReviewerId($repoInst,$reviewerId,$kind,$select){
        return $this->sakurasetRepository->getSheetInfoByReviewerId($repoInst,$reviewerId,$kind,$select);
    }
    public function createBackupData($repoInst,$namebk,$namedis,$memberId){
        return $this->sakurasetRepository->createBackupData($repoInst,$namebk,$namedis,$memberId);
    }
}
