<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;

class MyPageController extends Controller
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

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A001');

        return view('myPage/index',['guidanceData'=>$guidanceData]);
    }

}
