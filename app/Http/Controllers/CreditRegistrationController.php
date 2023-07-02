<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\GuidanceSettingService;
use App\Services\AnswerManageService;
use App\Services\AnswerInfoService;

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
     * MyPageController constructor.
     * @param GuidanceSettingService $guidanceSettingService
     */
    public function __construct(
        GuidanceSettingService $guidanceSettingService,
        AnswerManageService $answerManageService,
        AnswerInfoService $answerInfoService
    )
    {
        $this->guidanceSettingService = $guidanceSettingService;
        $this->answerManageService = $answerManageService;
        $this->answerInfoService = $answerInfoService;
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
        $creditsData = $this->answerInfoService->searchCredits($request->all());
        return response()->json(['data' => $creditsData]);
    }

    public function creditRegistry(Request $request)
    {
        return view('myPage/creditRegistration/registry');
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
            return redirect()->route('creditRegistry');
        } else {
            if (Session::get('popup_confirm')) {
                /* handle with database here */
                Session::forget('popup_confirm');
                return response()->json(['message' => 'successfully']);
            }
        }
    }
}
