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
    )
    {
        $this->guidanceSettingService = $guidanceSettingService;
        $this->answerManageService = $answerManageService;
        $this->answerInfoService = $answerInfoService;
        $this->questionManageService = $questionManageService;
        $this->questionSettingService = $questionSettingService;
        $this->questionOptionSettingService = $questionOptionSettingService;
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
        $data['type_native_id'] = 0;
        $creditsData = $this->answerInfoService->searchCredits($data);
        return response()->json(['data' => $creditsData]);
    }

    public function creditRegistry(Request $request)
    {
        $typeNativeId = 0;
        $guidanceData = $this->guidanceSettingService->getByScreenId('A004');
        $questionManageData = $this->questionManageService->getByTypeNativeId($typeNativeId);
        $questionId = $questionManageData->first()->id ?? '';
        $questionSettingData = $this->questionSettingService->getByQuestionId($questionId);
        $questionSettingChildData = $this->questionSettingService->getChildByQuestionId($questionId);

        return view('myPage/creditRegistration/registry',[
            'guidanceData' => $guidanceData,
            'questionSettingData' => $questionSettingData,
            'questionSettingChildData' => $questionSettingChildData,
            'typeNativeId' => $typeNativeId,
        ]);
    }
    public function creditEdit(Request $request)
    {
        $fakeData = (object)[
            "own_position" => 2,
            "SVR_attributes" => "nothing to know",
            "TOPL" => "hao ngo",
            "type_SV" => 2,
            "SV_frequency" => "2",
            "s_period" => "2023-07-02T23:48",
            "e_period" => "2023-07-14T23:48",
            "SV_contract" => "2023-07-21T23:48",
            "goal_study" => [
                "study_purpose" => ["1"],
                "SAAMOS" => ["3"],
                "PAAP" => ["5"],
                "brainstorming" => ["10"],
                "PEAR" => ["11"],
                "SWA" => ["13"],
            ]
        ];
        return view('myPage/creditRegistration/edit',['data' => $fakeData]);
    }

    public function handleCreditRegistry(Request $request)
    {

        /* show confirm */
        if ($request->has('confirm')) {
            Session::put('popup_confirm', $request->except(['_token', 'confirm']));
            $questionSettingIds = $this->questionSettingService->getQuestionIdByRegistry($request->all());
            $questionOptionSettingIds = $this->questionOptionSettingService->getQuestionOptionIdByRegistry($request->all());
            $questionSettingRegistryData = $this->questionSettingService->getByIds($questionSettingIds);
            $questionOptionSettingRegistryData = $this->questionOptionSettingService->getByIds($questionOptionSettingIds);
            Session::put('question_confirm', $questionSettingRegistryData);
            Session::put('question_option_confirm', $questionOptionSettingRegistryData);
            return redirect()->route('creditRegistry');
        } else {
            if (Session::get('popup_confirm')) {
                /* handle with database here */
                Session::forget('popup_confirm');
                return response()->json(['message' => 'successfully']);
            }
        }
    }

    public function getBranchQuestion(Request $request)
    {
        $questionSettingId = $request->get('question_setting_id');

        $questionSetting = $this->questionSettingService->getByParentQuestionOptionId($questionSettingId);
        $returnHTML = '';
        if($questionSetting){
            $viewQuestion = 'input_method_'.$questionSetting->input_method;
            $returnHTML = view('myPage/creditRegistration/question/'.$viewQuestion)->with('questionSetting', $questionSetting)->render();
        }

        return response()->json( array('success' => true, 'html'=>$returnHTML) );

    }
}
