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
    public function getSumCoreByTypeNativeId($year){
        return $this->answerManageRepository->sumCoreCredits($year);
    }

    public function getById($id = 0)
    {
        return $this->answerManageRepository->getById($id);
    }
    public function getSumScoreBwYear($from,$to)
    {
        return $this->answerManageRepository->sumCoreBwYear($from,$to);
    }
    public function getSumScoreBwYearGoalStudy($from,$to)
    {
        return $this->answerManageRepository->sumCoreBwYearGoalStudy($from,$to);
    }
    public function getSumScoreBwYearForPattern($from,$to)
    {
        return $this->answerManageRepository->sumScoreBwYearForPattern($from,$to);
    }

    /**
     * 単年度のみのデータを取得するメソッド
     * 
     * @param int $year 年度
     * @return \Illuminate\Support\Collection
     */
    public function getSumCoreByTypeNativeIdSingleYear($year)
    {
        return $this->answerManageRepository->sumCoreCreditsSingleYear($year);
    }

}

