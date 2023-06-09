<?php

namespace App\Services;

use App\Repositories\GuidanceSettingRepository;

class GuidanceSettingService
{
    /**
     * @var GuidanceSettingRepository
     */
    protected $guidanceSettingRepository;

    /**
     * GuidanceSettingService constructor.
     * @param GuidanceSettingRepository $guidanceSettingRepository
     */
    public function __construct(GuidanceSettingRepository $guidanceSettingRepository)
    {
        $this->guidanceSettingRepository = $guidanceSettingRepository;
    }

    public function getByScreenId(int $screenId = 0)
    {
        return $this->guidanceSettingRepository->getByScreenId($screenId);
    }
}
