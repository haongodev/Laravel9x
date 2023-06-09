<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;
class MyPageController extends Controller
{
    protected $guidanceSettingService;

    public function __construct(GuidanceSettingService $guidanceSettingService)
    {
        $this->guidanceSettingService = $guidanceSettingService;
    }
    public function index()
    {
        $content = $this->guidanceSettingService->getByScreenId('A001');
        return view('myPage/index',['content'=>$content]);
    }

}
