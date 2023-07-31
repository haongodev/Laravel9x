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
}
