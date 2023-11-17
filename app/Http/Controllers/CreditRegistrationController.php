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

    public function typeSelected(Request $request)
    {
        // Clear session form register
        forgetSessionCreditRegistry();
        //
        $typeNativeId = $request->get('type_native_id',0);
        $guidanceData = $this->guidanceSettingService->getByScreenId('A002');
        $registrationYearData = $this->answerManageService->getRegistrationYearByTypeNativeId($typeNativeId);
        $answerData = $this->answerInfoService->getAnswerByTypeNativeId($typeNativeId);

        return view('myPage/creditRegistration/typeSelected', [
            'guidanceData' => $guidanceData,
            'registrationYearData' => $registrationYearData,
            'answerData' => $answerData,
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
            $returnHTML = view('myPage/creditRegistration/search_type_selected',[
                'creditsData' => $creditsData,
                'typeNativeId' => $data['type_native_id']
            ])->render();
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
        ]);
    }

    public function creditEdit(Request $request)
    {
        $answerManageId = $request->get('answer_manage_id');
        $typeNativeId = $request->get('type_native_id');
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

        $questionManageData = $this->questionManageService->getByTypeNativeId($typeNativeId);
        $hisQuestionSettingData = $this->historyQuestionSettingService->getByOriginalQuestionIds($originalQuestionIds);
        $questionId = $questionManageData->first()->id ?? '';
        $hisQuestionSettingChildData = $this->historyQuestionSettingService->getChildByQuestionId($questionId);
        $hisQuestionSettingChildData = $this->historyQuestionSettingService->convertKeyToParentQuestionKey($hisQuestionSettingChildData);
        Session::put('question_child_data', $hisQuestionSettingChildData);

        return view('myPage/creditRegistration/edit', [
            'guidanceData' => $guidanceData,
            'questionSettingData' => $hisQuestionSettingData,
            'questionSettingChildData' => $hisQuestionSettingChildData,
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
                forgetSessionCreditRegistry();
                return response()->json(['message' => 'successfully']);
            }
        }
    }
    public function handleCreditDelete(Request $request){
        $hisQuestionSettingData = $this->historyQuestionSettingService->getByOriginalQuestionIds($request->origin_id);
        if(!$hisQuestionSettingData){
            return response()->json(array('success' => false,'data' => []));
        }
        $answerManage = $this->answerManageService->getById($request->answer_id);
        if($answerManage){
            // delete answer manager
            $answerManage->delete();
            // delete answer info
            $this->answerInfoService->deleteByAnswerManageId($request->answer_id);
        }
        // delete question setting option
        // $questionOptionSetting = $this->historyQuestionOptionSettingService->getByQuestionId($hisQuestionSettingData->id);
        // if($questionOptionSetting){
        //     $questionOptionSetting->delete();
        // }
        // $hisQuestionSettingData->delete();
        return response()->json(array('success' => true,'data' => []));
    }
    public function handleCreditUpdate(Request $request)
    {

        /* show confirm */
        if ($request->has('confirm')) {
            // Set session question + answer from form
            $typeNativeId = $request->get('type_native_id');
            Session::put('popup_confirm', $request->except(['_token', 'confirm']));
            Session::put('show_popup_confirm', true);
            $answerManageId = $request->get('answer_manage_id');
            $originalQuestionId = $request->get('original_question_id');
            $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
            $questionOptionSettingIds = $this->questionOptionSettingService->getQuestionOptionIdByRegistry($request->all());
            $questionSettingRegistryData = $this->historyQuestionSettingService->getByIds($questionSettingIds);
            $questionOptionSettingRegistryData = $this->historyQuestionOptionSettingService->getByIds($questionOptionSettingIds);
            //Get data question setting from form
            Session::put('question_confirm', $questionSettingRegistryData);
            //Get data question option setting from form
            Session::put('question_option_confirm', $questionOptionSettingRegistryData);
            return redirect()->route('creditEdit',['answer_manage_id'=>$answerManageId,'type_native_id'=>$typeNativeId]);
        } else {
            if (Session::get('popup_confirm')) {
                /* handle with database here */
                $answer = $this->creditRegistrationService->updateAnswer();
                if (!$answer) {
                    return redirect()->route('creditRegistry');
                }
                /**/
                forgetSessionCreditRegistry();
                return response()->json(['message' => 'successfully']);
            }
        }
    }
    public function getBranchQuestion(Request $request)
    {
        $questionOptionSettingId = $request->get('question_option_setting_id',-1);
        $type = $request->get('type','add');
        $checkViewVideo = $this->creditRegistrationService->checkViewVideoOption($questionOptionSettingId,$type);

        $returnHTML = '';
        if($checkViewVideo){
            $questionSetting = $this->questionSettingService->getByParentQuestionOptionId($questionOptionSettingId);
            $questionSettingChildData = Session::get('question_child_data');
            $answerInfoData = Session::get('answer_info_data');

            if ($questionSetting) {
                $viewQuestion = 'input_method_' . $questionSetting->input_method;
                $returnHTML = view('myPage/creditRegistration/question/' . $viewQuestion,[
                    'questionSetting'=> $questionSetting,
                    'answerInfoData' => $answerInfoData,
                    'questionSettingChildData' => $questionSettingChildData
                ])->render();
            }
        }else{
            $returnHTML = view('myPage/creditRegistration/question/validate_view_video_option_question',[

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
        $type = $request->get('type','edit');
        $checkViewVideo = $this->creditRegistrationService->checkViewVideoOption($questionOptionSettingId,$type);
        $returnHTML = '';
        if($checkViewVideo){
            $questionSetting = $this->historyQuestionSettingService->getByParentQuestionOptionId($questionOptionSettingId);
            $answerInfoData = Session::get('answer_info_data');

            if ($questionSetting) {
                $viewQuestion = 'input_method_' . $questionSetting->input_method;
                $returnHTML = view('myPage/creditRegistration/question/' . $viewQuestion, [
                    'questionSetting' => $questionSetting,
                    'answerInfoData' => $answerInfoData
                ])->render();
            }

        }else{
            $returnHTML = view('myPage/creditRegistration/question/validate_view_video_option_question',[

            ])->render();
        }

        return response()->json(array('success' => true, 'html' => $returnHTML));

    }

    public function popupRegistered(Request $request)
    {
        $answerManageId = $request->get('answer_manage_id');
        $originalQuestionId = $request->get('original_question_id');
        $typeNativeId = $request->get('type_native_id');
        $answerData = $this->answerInfoService->getByAnswerManageId($answerManageId);
        $returnHTML = '';
        if ($answerData) {
            $returnHTML = view('components/popup_confirm_registered', [
                'answerData' => $answerData,
                'answerManageId' => $answerManageId,
                'originalQuestionId' => $originalQuestionId,
                'typeNativeId' => $typeNativeId
            ])->render();
        }
        return $returnHTML;
    }

    /*
     * Validate from question setting
     * */
    public function validateViewVideo(Request $request)
    {
        $questionFormData = $request->get('question',[]);
        $typeNativeId = $request->get('type_native_id',0);


        $videoName = '';
        $isViewCheck = false;

        $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
        $questionSettingRegistryData = $this->questionSettingService->getByIds($questionSettingIds);
        $registerYear = $this->creditRegistrationService->getRegistrationYear($questionFormData,$questionSettingRegistryData);

        $answerVideo = $this->creditRegistrationService->filterAnswerQuestionViewVideo($questionFormData,'add');
        $condition = [
            'answerVideo' => $answerVideo,
            'registerYear' => $registerYear
        ];
        $answerInfoData = $this->creditRegistrationService->checkViewVideo($typeNativeId,$condition);
        if($answerInfoData){
            $videoName = $answerInfoData->answer;
            $isViewCheck = true;
        }

        return response()->json(array('success' => true, 'isViewCheck' => $isViewCheck,'videoName'=>$videoName));
    }

    public function validateViewVideoEdit(Request $request)
    {
        $questionFormData = $request->get('question',[]);
        $typeNativeId = $request->get('type_native_id',0);
        $answerManageId = $request->get('answer_manage_id',0);

        $videoName = '';
        $isViewCheck = false;
        $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
        $questionSettingRegistryData = $this->historyQuestionSettingService->getByIds($questionSettingIds);
        $registerYear = $this->creditRegistrationService->getRegistrationYear($questionFormData,$questionSettingRegistryData);
        $answerVideo = $this->creditRegistrationService->filterAnswerQuestionViewVideo($questionFormData,'edit');

        $condition = [
            'answerVideo' => $answerVideo,
            'registerYear' => $registerYear,
            'answerManageId' => $answerManageId
        ];
        $answerInfoData = $this->creditRegistrationService->checkViewVideo($typeNativeId,$condition,'edit');

        if($answerInfoData){
            $videoName = $answerInfoData->answer;
            $isViewCheck = true;
        }

        return response()->json(array('success' => true, 'isViewCheck' => $isViewCheck,'videoName'=>$videoName));
    }

}
