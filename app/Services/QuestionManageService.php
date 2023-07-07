<?php

namespace App\Services;

use App\Repositories\QuestionManageRepository;

class QuestionManageService
{
    /**
     * @var QuestionManageRepository
     */
    protected $questionManageRepository;

    /**
     * QuestionManageService constructor.
     * @param QuestionManageRepository $questionManageRepository
     */
    public function __construct(QuestionManageRepository $questionManageRepository)
    {
        $this->questionManageRepository = $questionManageRepository;
    }

    public function getByTypeNativeId($typeNativeId = 0)
    {
        return $this->questionManageRepository->getByTypeNativeId($typeNativeId);
    }

}

