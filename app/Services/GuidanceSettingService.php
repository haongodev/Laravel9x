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

    /**
     * @param int $screenId
     * @param array $filter
     * @return mixed
     */
    public function getByScreenId($screenId = 0, array $filter = [])
    {
        return $this->guidanceSettingRepository->getByScreenId($screenId, $filter);
    }
}
