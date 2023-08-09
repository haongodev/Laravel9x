<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\GuidanceSettingService;
use App\Services\AnswerManageService;
use App\Services\AnswerInfoService;
use App\Services\QuestionManageService;
use App\Services\QuestionSettingService;
use App\Services\QuestionOptionSettingService;
use App\Services\CreditRegistrationService;
use App\Services\HistoryQuestionSettingService;
use App\Services\HistoryQuestionOptionSettingService;

class CreditRegistrationController extends Controller
{
    /**
     * @var GuidanceSettingService
     */
    protected $guidanceSettingService;

    /**
     * @var AnswerManageService
     */
    protected $answerManageService;

    /**
     * @var AnswerInfoService
     */
    protected $answerInfoService;

    /**
     * @var QuestionManageService
     */
    protected $questionManageService;

    /**
     * @var QuestionSettingService
     */
    protected $questionSettingService;

    /**
     * @var QuestionOptionSettingService
     */
    protected $questionOptionSettingService;

    /**
     * @var CreditRegistrationService
     */
    protected $creditRegistrationService;

    /**
     * @var HistoryQuestionSettingService
     */
    protected $historyQuestionSettingService;

    /**
     * @var HistoryQuestionOptionSettingService
     */
    protected $historyQuestionOptionSettingService;

    /**
     * CreditRegistrationController constructor.
     * @param GuidanceSettingService $guidanceSettingService
     * @param AnswerManageService $answerManageService
     * @param AnswerInfoService $answerInfoService
     * @param QuestionManageService $questionManageService
     * @param QuestionSettingService $questionSettingService
     */
    public function __construct(
        GuidanceSettingService $guidanceSettingService,
        AnswerManageService $answerManageService,
        AnswerInfoService $answerInfoService,
        QuestionManageService $questionManageService,
        QuestionSettingService $questionSettingService,
        QuestionOptionSettingService $questionOptionSettingService,
        CreditRegistrationService $creditRegistrationService,
        HistoryQuestionSettingService $historyQuestionSettingService,
        HistoryQuestionOptionSettingService $historyQuestionOptionSettingService
    )
    {
        $this->guidanceSettingService = $guidanceSettingService;
        $this->answerManageService = $answerManageService;
        $this->answerInfoService = $answerInfoService;
        $this->questionManageService = $questionManageService;
        $this->questionSettingService = $questionSettingService;
        $this->questionOptionSettingService = $questionOptionSettingService;
        $this->creditRegistrationService = $creditRegistrationService;
        $this->historyQuestionSettingService = $historyQuestionSettingService;
        $this->historyQuestionOptionSettingService = $historyQuestionOptionSettingService;
    }

    public function index()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A002');
        return view('myPage/creditRegistration/index', ['guidanceData' => $guidanceData]);
    }

    public function typeSelected()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A002');
        $registrationYearData = $this->answerManageService->getRegistrationYearByTypeNativeId(0);
        $titleData = $this->answerInfoService->getTitleByTypeNativeId(0);
        return view('myPage/creditRegistration/typeSelected', [
            'guidanceData' => $guidanceData,
            'registrationYearData' => $registrationYearData,
            'titleData' => $titleData
        ]);
    }

    public function searchTypeSelected(Request $request)
    {
        $data = $request->all();
        //Current pattern
        $data['type_native_id'] = $data['type_native_id'] ?? 0;
        $creditsData = $this->answerInfoService->searchCredits($data);
        $returnHTML = '';
        if ($creditsData) {
            $returnHTML = view('myPage/creditRegistration/search_type_selected')->with('creditsData', $creditsData)->render();
        }
        return response()->json(['data' => $returnHTML]);
    }

    public function creditRegistry(Request $request)
    {
        $typeNativeId = $request->get('type_native_id',0);
        $guidanceData = $this->guidanceSettingService->getByScreenId('A004');
        $questionManageData = $this->questionManageService->getByTypeNativeId($typeNativeId);
        $questionId = $questionManageData->first()->id ?? '';
        $questionSettingData = $this->questionSettingService->getByQuestionId($questionId);
        $questionSettingChildData = $this->questionSettingService->getChildByQuestionId($questionId);
        $questionSettingChildData = $this->questionSettingService->convertKeyToParentQuestionKey($questionSettingChildData);
        Session::put('question_child_data', $questionSettingChildData);
        $arrTest = [
            '1'=>[2,3],
            '3' => [4,5],
            '5'=> [6,7],
            '8'=> [9,10]
        ];
        Session::put('arrTest', $arrTest);
        $answerInfoData = [];
        if(Session::get('popup_confirm')){
            $answerInfoData = $this->creditRegistrationService->getAnswerInfoForm();
            Session::put('answer_info_data', $answerInfoData);
        }
        return view('myPage/creditRegistration/registry', [
            'guidanceData' => $guidanceData,
            'questionSettingData' => $questionSettingData,
            'questionSettingChildData' => $questionSettingChildData,
            'typeNativeId' => $typeNativeId,
            'questionManagerId' => $questionId,
            'answerInfoData' => $answerInfoData,
            'isHasQuestion' => $questionSettingData->isEmpty() ? 0 : 1,
            'arrTest' => $arrTest
        ]);
    }

    public function creditEdit(Request $request)
    {
        $answerManageId = $request->get('answer_manage_id');
        if (!$answerManageId) {
            abort(404);
        }
        $guidanceData = $this->guidanceSettingService->getByScreenId('A007');
        $answerManage = $this->answerManageService->getById($answerManageId);
        $answerInfoData = $this->answerInfoService->getByAnswerManageId($answerManageId);
        $originalQuestionIds = $answerInfoData->pluck('original_question_id')->toArray();
        if(Session::get('popup_confirm')){
            $answerInfoData = $this->creditRegistrationService->getAnswerInfoForm();
        }

        Session::put('answer_info_data', $answerInfoData);
        //Get original question id get from answer info data


        $hisQuestionSettingData = $this->historyQuestionSettingService->getByOriginalQuestionIds($originalQuestionIds);

        return view('myPage/creditRegistration/edit', [
            'guidanceData' => $guidanceData,
            'questionSettingData' => $hisQuestionSettingData,
            'answerInfoData' => $answerInfoData,
            'answerManageId' => $answerManageId,
            'questionManagerId' => $answerManage->question_id,
            'typeNativeId' => $answerManage->type_native_id,
        ]);
    }

    public function handleCreditRegistry(Request $request)
    {

        /* show confirm */
        if ($request->has('confirm')) {
            $typeNativeId = $request->get('type_native_id');
            Session::put('popup_confirm', $request->except(['_token', 'confirm']));
            Session::put('show_popup_confirm', true);
            $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
            $questionOptionSettingIds = $this->questionOptionSettingService->getQuestionOptionIdByRegistry($request->all());
            $questionSettingRegistryData = $this->questionSettingService->getByIds($questionSettingIds);
            $questionOptionSettingRegistryData = $this->questionOptionSettingService->getByIds($questionOptionSettingIds);
            Session::put('question_confirm', $questionSettingRegistryData);
            Session::put('question_option_confirm', $questionOptionSettingRegistryData);
            return redirect()->route('creditRegistry',['type_native_id'=>$typeNativeId]);
        } else {
            if (Session::get('popup_confirm')) {
                /* handle with database here */
                $answer = $this->creditRegistrationService->insertAnswer();
                if (!$answer) {
                    return redirect()->route('creditRegistry');
                }
                /**/
                Session::forget('popup_confirm');
                Session::forget('question_confirm');
                Session::forget('question_option_confirm');
                return response()->json(['message' => 'successfully']);
            }
        }
    }

    public function handleCreditUpdate(Request $request)
    {

        /* show confirm */
        if ($request->has('confirm')) {
            // Set session question + answer from form
            Session::put('popup_confirm', $request->except(['_token', 'confirm']));
            $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
            $questionOptionSettingIds = $this->questionOptionSettingService->getQuestionOptionIdByRegistry($request->all());
            $questionSettingRegistryData = $this->historyQuestionSettingService->getByIds($questionSettingIds);
            $questionOptionSettingRegistryData = $this->historyQuestionOptionSettingService->getByIds($questionOptionSettingIds);
            //Get data question setting from form
            Session::put('question_confirm', $questionSettingRegistryData);
            //Get data question option setting from form
            Session::put('question_option_confirm', $questionOptionSettingRegistryData);
            return redirect()->route('creditEdit',['answer_manage_id'=>1,'original_question_id'=>1]);
        } else {
            if (Session::get('popup_confirm')) {
                /* handle with database here */
                $answer = $this->creditRegistrationService->updateAnswer();
                if (!$answer) {
                    return redirect()->route('creditRegistry');
                }
                /**/
                Session::forget('popup_confirm');
                Session::forget('question_confirm');
                Session::forget('question_option_confirm');
                Session::forget('answer_info_data');
                return response()->json(['message' => 'successfully']);
            }
        }
    }
    public function getBranchQuestion(Request $request)
    {
        $questionOptionSettingId = $request->get('question_option_setting_id',-1);

        $questionSetting = $this->questionSettingService->getByParentQuestionOptionId($questionOptionSettingId);
        $questionSettingChildData = Session::get('question_child_data');
        $answerInfoData = Session::get('answer_info_data');
        $returnHTML = '';
        if ($questionSetting) {
            $viewQuestion = 'input_method_' . $questionSetting->input_method;
            $returnHTML = view('myPage/creditRegistration/question/' . $viewQuestion,[
                'questionSetting'=> $questionSetting,
                'answerInfoData' => $answerInfoData,
                'questionSettingChildData' => $questionSettingChildData
            ])->render();
        }

        return response()->json(array('success' => true, 'html' => $returnHTML));

    }

    public function getLinkQuestion(Request $request)
    {
        $questionSettingId = $request->get('question_setting_id',-1);

        $questionSetting = $this->questionSettingService->getByParentQuestionId($questionSettingId);

        //process add class css when question input
        $isQuestionInput = false;
        $answerInfoData = Session::get('answer_info_data');
        $returnHTML = '';
        if ($questionSetting) {
            $isQuestionInput = $questionSetting->input_method == 0 || $questionSetting->input_method == 1 ? true : false;
            $viewQuestion = 'input_method_' . $questionSetting->input_method;
            $returnHTML = view('myPage/creditRegistration/question/' . $viewQuestion,[
                'questionSetting'=> $questionSetting,
                'answerInfoData' => $answerInfoData,

            ])->render();
        }

        return response()->json(array('success' => true, 'html' => $returnHTML, 'current_question_id'=>$questionSettingId, 'isQuestionInput'=>$isQuestionInput));

    }

    public function getBranchHisQuestion(Request $request)
    {
        $questionOptionSettingId = $request->get('question_option_setting_id',-1);

        $questionSetting = $this->historyQuestionSettingService->getByParentQuestionOptionId($questionOptionSettingId);
        $answerInfoData = Session::get('answer_info_data');

        $returnHTML = '';
        if ($questionSetting) {
            $viewQuestion = 'input_method_' . $questionSetting->input_method;
            $returnHTML = view('myPage/creditRegistration/question/' . $viewQuestion, [
                'questionSetting' => $questionSetting,
                'answerInfoData' => $answerInfoData
            ])->render();
        }

        return response()->json(array('success' => true, 'html' => $returnHTML));

    }

    public function popupRegistered(Request $request)
    {
        $answerManageId = $request->get('answer_manage_id');
        $originalQuestionId = $request->get('original_question_id');
        $answerData = $this->answerInfoService->getByAnswerManageId($answerManageId);
        $returnHTML = '';
        if ($answerData) {
            $returnHTML = view('components/popup_confirm_registered', [
                'answerData' => $answerData,
                'answerManageId' => $answerManageId,
                'originalQuestionId' => $originalQuestionId,
            ])->render();
        }
        return $returnHTML;
    }
}
