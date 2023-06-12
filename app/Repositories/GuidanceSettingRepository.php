<?php

namespace App\Repositories;

use App\Models\GuidanceSetting;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
class GuidanceSettingRepository extends  BaseRepository
{

    public function __construct(GuidanceSetting $model)
    {
        parent::__construct($model);

    }

    public function getByScreenId($screenId = 0)
    {
        return $this->model->where('screen_id', $screenId)->get()->first();
    }
}
