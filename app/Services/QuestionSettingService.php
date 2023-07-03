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
}

