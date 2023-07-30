<?php

namespace App\Services;

use App\Repositories\ReflectionsheetManageRepository;

class ReflectionsheetManageService
{
    /**
     * @var ReflectionsheetManageRepository
     */
    protected $reflectionsheetManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param ReflectionsheetManageRepository $reflectionsheetManageRepository
     */
    public function __construct(ReflectionsheetManageRepository $reflectionsheetManageRepository)
    {
        $this->reflectionsheetManageRepository = $reflectionsheetManageRepository;
    }

}
