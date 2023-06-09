<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\GuidanceSetting;
class GuidanceSettingRepository extends BaseRepository
{
    public function construct(GuidanceSetting $model)
    {
        parent::__construct($model);
    }

    public function getByScreenId(int $screenId = 0)
    {
        $this->model->where('screed_id', $screenId)->get()->first();
    }
}
