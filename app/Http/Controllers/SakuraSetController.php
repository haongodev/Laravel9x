<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;
use App\Services\SakurasetService;
use App\Services\UserAddInfoService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendMail;

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
        $with = [
            'made_member' => function ($query) {
                $query->select('id', 'users_id', 'name1', 'name2', 'email');
            },
            'reviewer_member' => function ($query) {
                $query->select('id', 'users_id', 'name1', 'name2', 'email');
            },
        ];
        $sakuraManage = $this->sakurasetService->getByLoggedId(['member_id',auth()->user()->id],$with);
        return view('myPage/sakuraSet/index',[
            'guidance' => $guidanceData,
            'sakuraManage' => $sakuraManage, 
        ]);
    }
    public function update(Request $request){
        if(!$request->all()){
            return response()->json(['success' => false, 'data' => []]);
        }
        $with = [
            'made_member' => function ($query) {
                $query->select('id', 'users_id', 'name1', 'name2', 'email');
            },
            'reviewer_member' => function ($query) {
                $query->select('id', 'users_id', 'name1', 'name2', 'email');
            },
        ];
        $sakuraManage = $this->sakurasetService->getByLoggedId(['member_id',auth()->user()->id],$with);
        $where = [
            'reviewer_id' => $sakuraManage->reviewer_member->users_id
        ];
        $dataUpdate = $request->except(['view']);
        $updateSakura = $this->sakurasetService->updateSakura($dataUpdate,$where);
        $msg = '';
        if($updateSakura){
            $msg = 'Updated Successfully';
            $emailConfig = ['to' => $sakuraManage->reviewer_member->email,'subject' => '[研修システム] お知らせ','sakuraData' => $sakuraManage->made_member];
            $view = 'email.sakuraSet.'.$request->view;
            if(!view()->exists($view)){
                $msg = 'Template Email do not exist';
            }else{
                $status = Mail::send(new SendMail($view, $emailConfig));
                if(!$status){
                    $msg = 'send email failed';
                }
            }
            return response()->json(['success' => true, 'message' => $msg,'data' => []]);
        }
    }
    public function delete(Request $request){
        if(!$request->all()){
            return response()->json(['success' => false, 'data' => []]);
        }
        $sakuraManage = $this->sakurasetService->getByLoggedId(['member_id',auth()->user()->id],['reviewer_member','made_member']);
        if($sakuraManage->reviewer_member){
            $emailConfig = ['to' => $sakuraManage->reviewer_member->email,'subject' => '[研修システム] お知らせ','sakuraData' => $sakuraManage->made_member];
            if($sakuraManage->delete()){
                $msg = 'Delete Successfully';
                $view = 'email.sakuraSet.'.$request->view;
                if(!view()->exists($view)){
                    $msg = 'Template Email do not exist';
                }else{
                    $status = Mail::send(new SendMail($view, $emailConfig));
                    if(!$status){
                        $msg = 'send email failed';
                    }
                }
            }
        }
        return response()->json(['success' => true, 'message' => $msg,'data' => []]);
    }
    public function yourTry(){
        return view('myPage/sakuraSet/yourTry');
    }
}
