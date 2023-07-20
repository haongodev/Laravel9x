<?php

namespace App\Services;

use App\Repositories\AnswerManageRepository;
use App\Repositories\AnswerInfoRepository;
use App\Repositories\HistoryQuestionSettingRepository;
use App\Repositories\HisoryQuestionOptionsSettingRepository;
use App\Repositories\QuestionSettingRepository;
use App\Repositories\QuestionOptionSettingRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreditRegistrationService
{
    /**
     * @var AnswerInfoRepository
     */
    protected $answerManageRepository;

    /**
     * @var AnswerInfoRepository
     */
    protected $answerInfoRepository;

    /**
     * @var HistoryQuestionSettingRepository
     */
    protected $historyQuestionSettingRepository;

    /**
     * @var HisoryQuestionOptionsSettingRepository
     */
    protected $historyQuestionOptionsSettingRepository;

    /**
     * @var QuestionSettingRepository
     */
    protected $questionSettingRepository;

    /**
     * @var QuestionOptionSettingRepository
     */
    protected $questionOptionSettingRepository;

    /**
     * CreditRegistrationService constructor.
     * @param AnswerManageRepository $answerManageRepository
     * @param AnswerInfoRepository $answerInfoRepository
     * @param HistoryQuestionSettingRepository $historyQuestionSettingRepository
     * @param HisoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository
     * @param QuestionSettingRepository $questionSettingRepository
     * @param QuestionOptionSettingRepository $questionOptionSettingRepository
     */
    public function __construct(
        AnswerManageRepository $answerManageRepository,
        AnswerInfoRepository $answerInfoRepository,
        HistoryQuestionSettingRepository $historyQuestionSettingRepository,
        HisoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository,
        QuestionSettingRepository $questionSettingRepository,
        QuestionOptionSettingRepository $questionOptionSettingRepository,
    )
    {
        $this->answerManageRepository = $answerManageRepository;
        $this->answerInfoRepository = $answerInfoRepository;
        $this->historyQuestionSettingRepository = $historyQuestionSettingRepository;
        $this->historyQuestionOptionsSettingRepository = $historyQuestionOptionsSettingRepository;
        $this->questionSettingRepository = $questionSettingRepository;
        $this->questionOptionSettingRepository = $questionOptionSettingRepository;
    }



    public function insertAnswer()
    {
        DB::beginTransaction();
        try {
            $dataInsertManager = $dataInsertInfo = [];
            $idManager = $this->getLastId() + 1;
            $formData = Session::get('popup_confirm');
            $questionManagerId = $formData['question_manager_id'];
            $dataInsertManager['id'] = $idManager;
            $dataInsertManager['question_id']  = $questionManagerId;
            $dataInsertManager['type_native_id']  = $formData['type_native_id'];
            $dataInsertManager['member_id']  = auth()->user()->id;
            $currentYear = date('m') > 3 ? date('Y') : date('Y', strtotime('-1 year'));
            $dataInsertManager['registration_year'] = $currentYear;
            $answerManager = $this->answerManageRepository->store($dataInsertManager);

            /* Insert data answer info */
            $dataInsertInfo = $this->filterDataAnswerInfo($idManager);
            $this->answerInfoRepository->store($dataInsertInfo);

            /* Insert history question setting*/
            $this->insertHistoryQuestionSetting($questionManagerId);
            /* Insert history question option setting*/
            $this->insertHistoryQuestionOptionSetting($questionManagerId);
            DB::commit();
            return $answerManager;
        } catch (QueryException $exc) {
            dd($exc->getMessage());
            DB::rollBack();
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }

    }

    public function getLastId()
    {
        $lastId = $this->answerManageRepository->getLastId();
        return $lastId ? $lastId : 0;
    }

    public function filterDataAnswerInfo($idManager = 0)
    {
        $dataInsertInfo = [];
        $formData = Session::get('popup_confirm');
        $questionSettingData = session('question_confirm');
        $questionOptionSettingData = session('question_option_confirm');
        $index  = 1;
        foreach ($formData['question'] as $questionSettingId => $answer) {
            $questionSetting = $questionSettingData[$questionSettingId];
            $dataInsertInfo[$index]['answer_manage_id'] = $idManager;
            $dataInsertInfo[$index]['original_question_id'] = $questionSettingId;
            $dataInsertInfo[$index]['type_native_id'] = $formData['type_native_id'];
            $dataInsertInfo[$index]['title'] = $questionSetting->title;
            $dataInsertInfo[$index]['level'] = $index;
            $dataInsertInfo[$index]['input_method'] = $questionSetting->input_method;
            $dataInsertInfo[$index]['terminal_flg'] = $questionSetting->terminal_flg ? 1: 0;
            $tempAnswer = '';
            $score = 0;
            if (!in_array($questionSetting->input_method, config('constants.questionBranching'))) {
                if (in_array($questionSetting->input_method, [0, 1])) {
                    $tempAnswer = $answer;
                } elseif ($questionSetting->input_method == 7) {
                    $tempAnswer = date('Y年 m月 d日',strtotime($answer));
                } elseif ($questionSetting->input_method == 8) {
                    $tempAnswer = date('Y年 m月 d日',strtotime($answer['start'])).' ~ '.date('Y年 m月 d日',strtotime($answer['end']));
                }
                $score = $questionSetting->score;
            } else {
                //Answer multi option
                if (in_array($questionSetting->input_method, [2, 3, 6])) {
                    foreach ($answer as $key2 => $answer2) {
                        $comma = $tempAnswer ? ',' : '';
                        $tempAnswer .= $comma.$questionOptionSettingData[$answer2]->option_name;
                        $score+=$questionOptionSettingData[$answer2]->score;
                    }
                } else {
                    {
                        $tempAnswer = $questionOptionSettingData[$answer]->option_name;
                        $score = $questionOptionSettingData[$answer]->score;
                    }
                }
            }
            $dataInsertInfo[$index]['answer'] = $tempAnswer;
            $dataInsertInfo[$index]['score'] = $score;
            $dataInsertInfo[$index]['update_date'] = Carbon::now();
            $dataInsertInfo[$index]['registration_date'] = Carbon::now();
            $index++;
        }
        return $dataInsertInfo;

    }

    public function insertHistoryQuestionSetting($questionId = 0)
    {
        $questionSettingData = $this->questionSettingRepository->getByQuestionId($questionId,true)->toArray();
        foreach ($questionSettingData as $questionSetting){
            $his = $this->historyQuestionSettingRepository->store($questionSetting);
        }
        return $his;
    }

    public function insertHistoryQuestionOptionSetting($questionId = 0)
    {
        $questionOptionSettingData = $this->questionOptionSettingRepository->getByQuestionId($questionId)->toArray();
        foreach ($questionOptionSettingData as $questionOptionSetting){
            $his = $this->historyQuestionOptionsSettingRepository->store($questionOptionSetting);
        }
        return $his;
    }
}

