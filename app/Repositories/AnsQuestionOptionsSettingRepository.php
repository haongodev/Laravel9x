<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\AnsQuestionOptionsSetting;
class AnsQuestionOptionsSettingRepository extends BaseRepository
{
    public function construct(AnsQuestionOptionsSetting $model)
    {
        parent::__construct($model);
    }
}
