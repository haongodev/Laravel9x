<?php

namespace App\Services;

use App\Repositories\HistoryQuestionOptionsSettingRepository;

class HistoryQuestionOptionSettingService
{
    /**
     * @var HistoryQuestionOptionsSettingRepository
     */
    protected $historyQuestionOptionsSettingRepository;

    /**
     * HistoryQuestionOptionSettingService constructor.
     * @param HistoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository
     */
    public function __construct(HistoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository)
    {
        $this->historyQuestionOptionsSettingRepository = $historyQuestionOptionsSettingRepository;
    }

    public function getByIds($ids = [])
    {
        return $this->historyQuestionOptionsSettingRepository->getByIds($ids);
    }
    public function getByQuestionId($questionId = 0)
    {
        return $this->historyQuestionOptionsSettingRepository->getByQuestionId($questionId);
    }
    public function delByAnsManageId($ans_manage_id = 0)
    {
        return $this->historyQuestionOptionsSettingRepository->delByAnsManageId($ans_manage_id);
    }
    
}
