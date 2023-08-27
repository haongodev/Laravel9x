<?php

namespace App\Services;

use App\Repositories\InitiativetableManageRepository;

class InitiativetableManageService
{
    /**
     * @var InitiativetableManageRepository
     */
    protected $initiativetableManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param InitiativetableManageRepository $initiativetableManageRepository
     */
    public function __construct(InitiativetableManageRepository $initiativetableManageRepository)
    {
        $this->initiativetableManageRepository = $initiativetableManageRepository;
    }
}
