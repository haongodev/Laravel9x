<?php

namespace App\Services;

use App\Repositories\QuestionOptionSettingRepository;

class QuestionOptionSettingService
{
    /**
     * @var
     */
    protected $questionOptionSettingRepository;

    /**
     * QuestionOptionSettingService constructor.
     * @param QuestionOptionSettingRepository $questionOptionSettingRepository
     */
    public function __construct(QuestionOptionSettingRepository $questionOptionSettingRepository)
    {
        $this->questionOptionSettingRepository = $questionOptionSettingRepository;
    }

    public function getQuestionOptionIdByRegistry(array $dataRegistry = [])
    {
        $data = [];
        if (!empty($dataRegistry['question'])) {
            foreach ($dataRegistry['question'] as $key => $value) {
                if(is_array($value)){
                  foreach ($value as $key2 => $value2){
                      $data[] = $value2;
                  }
                }else{
                    $data[] = $value;
                }

            }
        }
        return $data;
    }

    public function getByIds(array $ids = [])
    {
        if(!$ids){
            $ids = [-1];
        }
        return $this->questionOptionSettingRepository->getByIds($ids);
    }

}

