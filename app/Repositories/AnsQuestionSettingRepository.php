<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\AnsQuestionSetting;
class AnsQuestionSettingRepository extends BaseRepository
{
    public function construct(AnsQuestionSetting $model)
    {
        parent::__construct($model);
    }
}
