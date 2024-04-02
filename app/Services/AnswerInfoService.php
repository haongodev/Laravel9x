<?php

namespace App\Services;

use App\Repositories\AnswerInfoRepository;
use Illuminate\Support\Facades\Session;

class AnswerInfoService
{
    /**
     * @var AnswerInfoRepository
     */
    protected $answerInfoRepository;

    /**
     * AnswerInfoService constructor.
     * @param AnswerInfoRepository $answerInfoRepository
     */
    public function __construct(AnswerInfoRepository $answerInfoRepository)
    {
        $this->answerInfoRepository = $answerInfoRepository;
    }

    public function getPattern()
    {
        return $this->answerInfoRepository->getPattern();
    }

    public function getTitleByTypeNativeId($typeNativeId = 0)
    {
        return $this->answerInfoRepository->getTitleByTypeNativeId($typeNativeId);
    }

    public function getAnswerByTypeNativeId($typeNativeId = 0)
    {
        return $this->answerInfoRepository->getAnswerByTypeNativeId($typeNativeId);
    }

    public function searchCredits(array $data = [])
    {
        return $this->answerInfoRepository->searchCredits($data);
    }

    public function getByAnswerManageId($answerManageId = 0)
    {
        return $this->answerInfoRepository->getByAnswerManageId($answerManageId);
    }
    public function deleteByAnswerManageId($answerManageId = 0)
    {
        return $this->answerInfoRepository->deleteByAnswerManageId($answerManageId);
    }
    public function getAnswerHis($idQest,$questTitle,$year){
        return $this->answerInfoRepository->getAnswerHis($idQest,$questTitle,$year);
    }
    public function getAnswerHisArr($idQest,$questTitle,$answer,$year){
        return $this->answerInfoRepository->getAnswerHisArr($idQest,$questTitle,$answer,$year);
    }
}
