<?php

namespace App\Services;

use App\Repositories\FacesheetManageRepository;

class FacesheetManageService
{
    /**
     * @var FacesheetManageRepository
     */
    protected $facesheetManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param FacesheetManageRepository $facesheetManageRepository
     */
    public function __construct(FacesheetManageRepository $facesheetManageRepository)
    {
        $this->facesheetManageRepository = $facesheetManageRepository;
    }
}
