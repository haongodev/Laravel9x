<?php

namespace App\Services;

use App\Repositories\QuestionOptionSettingRepository;

class QuestionOptionSettingService
{
    /**
     * @var
     */
    protected $questionOptionSettingRepository;

    /**
     * QuestionOptionSettingService constructor.
     * @param QuestionOptionSettingRepository $questionOptionSettingRepository
     */
    public function __construct(QuestionOptionSettingRepository $questionOptionSettingRepository)
    {
        $this->questionOptionSettingRepository = $questionOptionSettingRepository;
    }

}

