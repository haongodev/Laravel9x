<?php

namespace App\Repositories;

use App\Models\GuidanceSetting;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class GuidanceSettingRepository extends BaseRepository
{

    /**
     * GuidanceSettingRepository constructor.
     * @param GuidanceSetting $model
     */
    public function __construct(GuidanceSetting $model)
    {
        parent::__construct($model);

    }

    /**
     * @param int $screenId
     * @param array $filter
     * @return mixed
     */
    public function getByScreenId($screenId = 0, array $filter = [])
    {
        $locationId = $filter['location_id'] ?? '';
        return $this->model
            ->where('screen_id', $screenId)
            ->when(!empty($locationId), function ($query) use ($locationId) {
                return $query->where('location_id', $locationId);
            })
            ->orderBy('location_id')->get()->keyBy('location_id');
    }
}
