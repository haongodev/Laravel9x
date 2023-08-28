<?php

namespace App\Services;

use App\Repositories\QuestionSettingRepository;

class QuestionSettingService
{
    /**
     * @var QuestionSettingRepository
     */
    protected $questionSettingRepository;

    /**
     * QuestionSettingService constructor.
     * @param QuestionSettingRepository $questionSettingRepository
     */
    public function __construct(QuestionSettingRepository $questionSettingRepository)
    {
        $this->questionSettingRepository = $questionSettingRepository;
    }

    public function getByQuestionId($questionId = 0)
    {
        return $this->questionSettingRepository->getByQuestionId($questionId);
    }

    public function getChildByQuestionId($questionId = 0)
    {
        return $this->questionSettingRepository->getChildByQuestionId($questionId);
    }


    public function getById($id = 0)
    {
        return $this->questionSettingRepository->getById($id);
    }

    public function getByParentQuestionOptionId($parentId = 0)
    {
        return $this->questionSettingRepository->getByParentQuestionOptionId($parentId);
    }

    public function getByParentQuestionId($parentId = 0)
    {
        return $this->questionSettingRepository->getByParentQuestionId($parentId);
    }

    public function getQuestionIdByRegistry($dataRegistry = [])
    {
        $data = [];
        if (!empty($dataRegistry['question'])) {
            foreach ($dataRegistry['question'] as $key => $value) {
                $data[] = $key;
            }
        }
        return $data;
    }

    public function getByIds(array $ids = [])
    {
        if(!$ids){
            $ids = [-1];
        }
        return $this->questionSettingRepository->getByIds($ids);
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

