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
