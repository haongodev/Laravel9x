<?php

namespace App\Services;

use App\Repositories\HistoryQuestionSettingRepository;

class HistoryQuestionSettingService
{
    /**
     * @var HistoryQuestionSettingRepository
     */
    protected $historyQuestionSettingRepository;

    /**
     * HistoryQuestionSettingService constructor.
     * @param HistoryQuestionSettingRepository $historyQuestionSettingRepository
     */
    public function __construct(HistoryQuestionSettingRepository $historyQuestionSettingRepository)
    {
        $this->historyQuestionSettingRepository = $historyQuestionSettingRepository;
    }

    public function getByOriginalQuestionIds($originalQuestionIds = 0)
    {
        $originalQuestionIds = is_array($originalQuestionIds) ? $originalQuestionIds : [$originalQuestionIds];

        return $this->historyQuestionSettingRepository->getByOriginalQuestionIds($originalQuestionIds);
    }

    public function getByParentQuestionOptionId($parentId = 0)
    {
        return $this->historyQuestionSettingRepository->getByParentQuestionOptionId($parentId);
    }

    public function getByIds($ids = [])
    {
        return $this->historyQuestionSettingRepository->getByIds($ids);
    }

    public function getChildByQuestionId($questionId = 0)
    {
        return $this->historyQuestionSettingRepository->getChildByQuestionId($questionId);
    }

    public function convertKeyToParentQuestionKey($questionSettingData)
    {
        $data = [];
        foreach ($questionSettingData as $key => $questionSetting){
            $data[$questionSetting->parent_question_id][]= $questionSetting;
        }
        return $data;
    }
}
