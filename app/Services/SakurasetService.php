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
    public function updateOrInsertSakura($dataUpdate,$where){
        return $this->sakurasetRepository->updateOrInsertSakura($dataUpdate,$where);
    }
    public function getReviewerbyMember($member){
        return $this->sakurasetRepository->getReviewer($member);
    }
    public function getFileInfoByReviewerId($repoInst,$reviewerId,$kind,$select){
        return $this->sakurasetRepository->getSheetInfoByReviewerId($repoInst,$reviewerId,$kind,$select);
    }
    public function createBackupData($repoInst,$namebk,$namedis,$memberId,$class){
        return $this->sakurasetRepository->createBackupData($repoInst,$namebk,$namedis,$memberId,$class);
    }
    public function updateSchedule($date)
    {
        $memberId = auth()->user()->id;
        return $this->sakurasetRepository->updateSchedule($date,$memberId);
    }
    public function createSakura($data){
        return $this->sakurasetRepository->createSakura($data);
    }
}
