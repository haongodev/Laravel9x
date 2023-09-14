<?php

namespace App\Services;

use App\Repositories\AnswerManageRepository;
use App\Repositories\AnswerInfoRepository;
use App\Repositories\HistoryQuestionSettingRepository;
use App\Repositories\HistoryQuestionOptionsSettingRepository;
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
     * @param HistoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository
     * @param QuestionSettingRepository $questionSettingRepository
     * @param QuestionOptionSettingRepository $questionOptionSettingRepository
     */
    public function __construct(
        AnswerManageRepository $answerManageRepository,
        AnswerInfoRepository $answerInfoRepository,
        HistoryQuestionSettingRepository $historyQuestionSettingRepository,
        HistoryQuestionOptionsSettingRepository $historyQuestionOptionsSettingRepository,
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
         //   $currentYear = date('m') > 3 ? date('Y') : date('Y', strtotime('-1 year'));

            $registrationYear = $this->getRegistrationYear($formData['question'],session('question_confirm'));
            $dataInsertManager['registration_year'] = $registrationYear;
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
            dd(1);
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
            $dataInsertInfo[$index]['effective_date_flg'] = $questionSetting->effective_date_flg;
            $dataInsertInfo[$index]['disp_flg'] = $questionSetting->disp_flg;
            $dataInsertInfo[$index]['viewing_check_flg'] = $questionSetting->viewing_check_flg;
            $tempAnswer = '';
            $score = 0;

            if (!in_array($questionSetting->input_method, config('constants.questionBranching'))) {
                if (in_array($questionSetting->input_method, [0, 1, 10])) {
                    $tempAnswer = $answer;
                } elseif ($questionSetting->input_method == 7) {
                    $tempAnswer = date('Y-m-d H:i:s',strtotime($answer));
                } elseif ($questionSetting->input_method == 8) {
                    $tempAnswer = date('Y-m-d H:i:s',strtotime($answer['start'])).' , '.date('Y-m-d H:i:s',strtotime($answer['end']));
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
                        $tempAnswer = $questionOptionSettingData[$answer]->option_name ?? '';
                        $score = $questionOptionSettingData[$answer]->score ?? 0;
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
            $condition = ['id'=>$questionSetting['id']];
            $his = $this->historyQuestionSettingRepository->store($condition,$questionSetting);
        }
        return $his;
    }

    public function insertHistoryQuestionOptionSetting($questionId = 0)
    {
        $questionOptionSettingData = $this->questionOptionSettingRepository->getByQuestionId($questionId)->toArray();
        foreach ($questionOptionSettingData as $questionOptionSetting){
            $condition = ['id'=>$questionOptionSetting['id']];
            $his = $this->historyQuestionOptionsSettingRepository->store($condition,$questionOptionSetting);
        }
        return $his;
    }

    public function updateAnswer()
    {
        DB::beginTransaction();
        try {
            $dataUpdateManager = $dataInsertInfo = [];
            $formData = Session::get('popup_confirm');
            $answerManageId = $formData['answer_manage_id'];

            $questionManageId = $formData['question_manager_id'];
            $dataUpdateManager['id'] = $answerManageId;
            $dataUpdateManager['question_id']  = $questionManageId;
            $dataUpdateManager['type_native_id']  = $formData['type_native_id'];
            $dataUpdateManager['member_id']  = auth()->user()->id;
            //$currentYear = date('m') > 3 ? date('Y') : date('Y', strtotime('-1 year'));
            $registrationYear = $this->getRegistrationYear($formData['question'],session('question_confirm'));
            $dataUpdateManager['registration_year'] = $registrationYear;
            $answerManager = $this->answerManageRepository->update($answerManageId,$dataUpdateManager);

            /*Delete old data before insert*/
            $this->answerInfoRepository->deleteAnswerManagerById($answerManageId);
            /* Insert data answer info */
            $dataInsertInfo = $this->filterDataAnswerInfo($answerManageId);
            $this->answerInfoRepository->store($dataInsertInfo);

            /* Insert history question setting*/
            $this->insertHistoryQuestionSetting($questionManageId);
            /* Insert history question option setting*/
            $this->insertHistoryQuestionOptionSetting($questionManageId);
            DB::commit();
            return $answerManager;
        } catch (QueryException $exc) {
            DB::rollBack();
            Log::error($exc->getMessage(), $exc->getTrace());
            return false;
        }
    }

    /**
     * Create sample answer info from form
     */
    public function getAnswerInfoForm()
    {
        $answerData = $data = [];

        $formData = Session::get('popup_confirm');
        $questionSettingData = session('question_confirm');
        $questionOptionSettingData = session('question_option_confirm');
        if(empty($formData['question'])){
            return  $data;
        }
        foreach ($formData['question'] as $questionSettingId => $answer) {
            if(!$answer){continue;}
            $questionSetting = $questionSettingData[$questionSettingId];
            $tempAnswer = '';
            $score = 0;
            if (!in_array($questionSetting->input_method, config('constants.questionBranching'))) {
                if (in_array($questionSetting->input_method, [0, 1, 10])) {
                    $tempAnswer = $answer;
                } elseif ($questionSetting->input_method == 7) {
                    $tempAnswer = date('Y-m-d H:i:s',strtotime($answer));
                } elseif ($questionSetting->input_method == 8) {
                    $tempAnswer = date('Y-m-d H:i:s',strtotime($answer['start'])).' , '.date('Y-m-d H:i:s',strtotime($answer['end']));
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
                    }
                }
            }
            $answerData['answer'] = $tempAnswer;
            $data[$questionSettingId]= (object)$answerData;
        }
        //Session::forget('popup_confirm');
        //Session::forget('question_confirm');
       // Session::forget('question_option_confirm');

        return $data;

    }

    public function getRegistrationYear($questionFormData = [], $questionSettingData = [])
    {
        $date = '';
        if(!empty($questionFormData)){
            foreach ($questionFormData as $questionSettingId => $answer){
                if($date){
                    break;
                }
                if($questionSettingData[$questionSettingId]['effective_date_flg'] == 1){
                    if($questionSettingData[$questionSettingId]['input_method'] == 7) {
                        $date = $answer;
                    }elseif($questionSettingData[$questionSettingId]['input_method'] == 8){
                        $date = $answer['start'];
                    }elseif($questionSettingData[$questionSettingId]['input_method'] == 10){
                        return $answer;
                    }
                }
            }
        }

        return date('m',strtotime($date)) > 3 ? date('Y',strtotime($date)) : date('Y',strtotime('-1 year', strtotime($date))) ;

    }

    public function filterAnswerQuestionViewVideo($formData)
    {
        $answerArr = [];
        $questionSettingIds = array_keys($formData);
        $questionFlagVideo = $this->questionSettingRepository->getViewCheckFlagTrueByIds($questionSettingIds)->keyBy('id');

        //$questionFlagVideoId = $this->questionSettingRepository->getViewCheckFlagTrueByIds($questionSettingIds)->pluck('id')->toArray();
        foreach ($questionFlagVideo as $id => $questionSetting){
            $tempAnswer = '';
            if (!in_array($questionSetting->input_method, config('constants.questionBranching'))) {
                $answer = $formData[$id];
                if (in_array($questionSetting->input_method, [0, 1])) {
                    $answerArr[] = $answer;
                } elseif ($questionSetting->input_method == 7) {
                    $answerArr[] = date('Y-m-d H:i:s',strtotime($answer));
                } elseif ($questionSetting->input_method == 8) {
                    $answerArr[] = date('Y-m-d H:i:s',strtotime($answer['start'])).' , '.date('Y-m-d H:i:s',strtotime($answer['end']));
                }
            }else{
                $answer = $formData[$id];
                if (in_array($questionSetting->input_method, [2, 3, 6])) {
                    foreach ($questionSetting->question_option_setting as  $questionOption) {
                        if(in_array($questionOption->id,$answer)){
                            $comma = $tempAnswer ? ',' : '';
                            $tempAnswer .= $comma.$questionOption->option_name;
                        }
                    }
                } else {
                    foreach ($questionSetting->question_option_setting as  $questionOption) {
                        if ($questionOption->id == $answer) {

                            $tempAnswer = $questionOption->option_name;
                        }
                    }
                }
                $answerArr[] = $tempAnswer;
            }
        }

        return $answerArr;
    }
    public function checkViewVideo($typeNativeId = 0, $condition = [])
    {

        return $this->answerManageRepository->checkViewVideo($typeNativeId,$condition);
    }

}

