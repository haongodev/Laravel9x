<?php

namespace App\Services;

use App\Repositories\AnswerInfoRepository;

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
}
