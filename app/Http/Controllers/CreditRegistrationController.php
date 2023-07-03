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
    )
    {
        $this->guidanceSettingService = $guidanceSettingService;
        $this->answerManageService = $answerManageService;
        $this->answerInfoService = $answerInfoService;
        $this->questionManageService = $questionManageService;
        $this->questionSettingService = $questionSettingService;
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
        $guidanceData = $this->guidanceSettingService->getByScreenId('A004');
        $questionManageData = $this->questionManageService->getByTypeNativeId(0);
        $questionId = $questionManageData->first()->id ?? '';
        $questionSettingData = $this->questionSettingService->getByQuestionId($questionId);
        $questionSettingChildData = $this->questionSettingService->getChildByQuestionId($questionId);

        return view('myPage/creditRegistration/registry',[
            'guidanceData' => $guidanceData,
            'questionSettingData' => $questionSettingData,
            'questionSettingChildData' => $questionSettingChildData
        ]);
    }

    public function handleCreditRegistry(Request $request)
    {
        /* show confirm */
        if ($request->has('confirm')) {
            Session::put('popup_confirm', $request->except(['_token', 'confirm']));
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
