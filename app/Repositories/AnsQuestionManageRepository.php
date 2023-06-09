<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\AnsQuestionMange;

class AnsQuestionManageRepository extends BaseRepository
{
    public function construct(AnsQuestionMange $model)
    {
        parent::__construct($model);
    }
}
