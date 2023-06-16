<?php

namespace App\Services;

use App\Repositories\AnswerManageRepository;

class AnswerManageService
{
    /**
     * @var AnswerInfoRepository
     */
    protected $answerManageRepository;

    /**
     * AnswerInfoService constructor.
     * @param AnswerInfoRepository $answerInfoRepository
     */
    public function __construct(AnswerManageRepository $answerManageRepository)
    {
        $this->answerManageRepository = $answerManageRepository;
    }

    public function getRegistrationYearByTypeNativeId($typeNativeId = 0)
    {
        return $this->answerManageRepository->getRegistrationYearByTypeNativeId($typeNativeId);
    }
}

