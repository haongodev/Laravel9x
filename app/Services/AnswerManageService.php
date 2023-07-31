<?php

namespace App\Services;

use App\Repositories\AnswerManageRepository;
use App\Repositories\AnswerInfoRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AnswerManageService
{
    /**
     * @var AnswerInfoRepository
     */
    protected $answerManageRepository;
    protected $answerInfoRepository;

    /**
     * AnswerManageService constructor.
     * @param AnswerManageRepository $answerManageRepository
     * @param AnswerInfoRepository $answerInfoRepository
     */
    public function __construct(
        AnswerManageRepository $answerManageRepository,
        AnswerInfoRepository $answerInfoRepository
    )
    {
        $this->answerManageRepository = $answerManageRepository;
        $this->answerInfoRepository = $answerInfoRepository;
    }

    public function getRegistrationYearByTypeNativeId($typeNativeId = 0)
    {
        return $this->answerManageRepository->getRegistrationYearByTypeNativeId($typeNativeId);
    }

    public function getById($id = 0)
    {
        return $this->answerManageRepository->getById($id);
    }

}

