<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;

class CreditRegistrationController extends Controller
{
    /**
     * @var GuidanceSettingService
     */
    protected $guidanceSettingService;

    /**
     * MyPageController constructor.
     * @param GuidanceSettingService $guidanceSettingService
     */
    public function __construct(GuidanceSettingService $guidanceSettingService)
    {
        $this->guidanceSettingService = $guidanceSettingService;
    }
    public function index()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A002');
        return view('myPage/creditRegistration/index',['guidanceData'=>$guidanceData]);
    }

    public function registry()
    {
        return view('myPage/creditRegistration/registry');
    }
}
