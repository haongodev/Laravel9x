<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;
use App\Services\SakurasetService;
use App\Services\UserAddInfoService;

class SakuraSetController extends Controller
{
    /**
     * @var GuidanceSettingService
     */
    protected $guidanceSettingService;
    /**
     * @var SakurasetService
     */
    protected $sakurasetService;
    /**
     * @var UserAddInfoService
     */
    protected $userAddInfoService;

    /**
     * SakuraSet constructor.
     * @param GuidanceSettingService $guidanceSettingService
     * @param SakurasetService $sakurasetService
     * @param UserAddInfoService $userAddInfoService
     */
    public function __construct(
        GuidanceSettingService $guidanceSettingService,
        SakurasetService $sakurasetService,
        UserAddInfoService $userAddInfoService){
        $this->guidanceSettingService = $guidanceSettingService;
        $this->sakurasetService = $sakurasetService;
        $this->userAddInfoService = $userAddInfoService;
    }
    public function index()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A011',['location_id' => 1]);
        $sakuraMember = $this->sakurasetService->getByLoggedId(['member_id',auth()->user()->id]);
        $sakuraReview = $this->sakurasetService->getByLoggedId(['reviewer_id',auth()->user()->id],'list','user_add_info');
        $userInfo = null;
        if($sakuraMember){
            $userInfo = $this->userAddInfoService->getByUserId($sakuraMember->member_id,['name1','name2','email']);
        }
        return view('myPage/sakuraSet/index',[
            'guidance' => $guidanceData,
            'userInfo' => $userInfo, 
            'sakuraMember' => $sakuraMember, 
            'sakuraReview' => $sakuraReview,
        ]);
    }
    public function yourTry(){
        return view('myPage/sakuraSet/yourTry');
    }
}
