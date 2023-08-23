<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;
use App\Services\SakurasetService;
use App\Services\UserAddInfoService;
use App\Services\FacesheetManageService;
use App\Services\ReflectionsheetManageService;
use App\Repositories\FacesheetManageRepository;
use App\Repositories\InitiativetableManageRepository;
use App\Repositories\ReflectionsheetManageRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * @var FacesheetManageRepository
     */
    protected $facesheetManageRepository;
    /**
     * @var InitiativetableManageRepository
     */
    protected $initiativetableManageRepository;
    /**
     * @var ReflectionsheetManageRepository
     */
    protected $reflectionsheetManageRepository;

    /**
     * @var FacesheetManageService
     */
    protected $facesheetManageService;

    /**
     * @var ReflectionsheetManageService
     */
    protected $reflectionsheetManageService;

    /**
     * SakuraSetController constructor.
     * @param GuidanceSettingService $guidanceSettingService
     * @param SakurasetService $sakurasetService
     * @param UserAddInfoService $userAddInfoService
     * @param FacesheetManageRepository $facesheetManageRepository
     * @param InitiativetableManageRepository $initiativetableManageRepository
     * @param ReflectionsheetManageRepository $reflectionsheetManageRepository
     * @param FacesheetManageService $facesheetManageService
     * @param ReflectionsheetManageService $reflectionsheetManageService
     */
    public function __construct(
        GuidanceSettingService $guidanceSettingService,
        SakurasetService $sakurasetService,
        UserAddInfoService $userAddInfoService,
        FacesheetManageRepository $facesheetManageRepository,
        InitiativetableManageRepository $initiativetableManageRepository,
        ReflectionsheetManageRepository $reflectionsheetManageRepository,
        FacesheetManageService $facesheetManageService,
        ReflectionsheetManageService $reflectionsheetManageService
    ){
        $this->guidanceSettingService = $guidanceSettingService;
        $this->sakurasetService = $sakurasetService;
        $this->userAddInfoService = $userAddInfoService;
        $this->facesheetManageRepository = $facesheetManageRepository;
        $this->initiativetableManageRepository = $initiativetableManageRepository;
        $this->reflectionsheetManageRepository = $reflectionsheetManageRepository;
        $this->facesheetManageService = $facesheetManageService;
        $this->reflectionsheetManageService = $reflectionsheetManageService;
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
        $faceSheetManagerData = $this->facesheetManageService->getByUserId(auth()->user()->id);
        $reflectionSheetManagerData = $this->reflectionsheetManageService->getByUserId(auth()->user()->id);

        return view('myPage/sakuraSet/yourTry',[
            'faceSheetManagerData' => $faceSheetManagerData,
            'reflectionSheetManagerData' => $reflectionSheetManagerData,
        ]);
    }
    public function getSheet(Request $request){
        $reviewer = $this->sakurasetService->getReviewerbyMember(auth()->user()->id);
        if($reviewer === null){
            return response()->json(['success' => false, 'message' => 'Reviewer do not exist','data' => []]);
        }
        $faceSheet = $this->sakurasetService->getFileInfoByReviewerId($this->facesheetManageRepository,$reviewer['member_id'],'only',['id','file_name','display_name','member_id']);
        $refSheet = $this->sakurasetService->getFileInfoByReviewerId($this->reflectionsheetManageRepository,$reviewer['member_id'],'list',['id','file_name','display_name','member_id','class']);
        $initTable = $this->sakurasetService->getFileInfoByReviewerId($this->initiativetableManageRepository,$reviewer['member_id'],'only',['id','file_name','display_name','member_id']);
        $data = [
            'facesheet' => $faceSheet,
            'freflectionsheet' => $refSheet,
            'initiative' => $initTable,
        ];
        return response()->json(['success' => true, 'message' => 'success','data' => $data]);
    }
    public function backup(Request $request){
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
        ]);
        if ($validator->fails()) {
            $data['success'] = false;
            $data['message'] = $validator->errors()->first('file');// Error response
        }else{
            $instance = null;
            $repo = null;
            $class = null;
            if($request->file('file')) {
                $file = $request->file('file');
                $location = 'storage/'.$request->member_id.'/'.$request->backup_type;
                if($request->at){
                    $location .= '/'.$request->at;
                    if($request->at === 'at'){
                        $class = 2;
                    }elseif($request->at === '6m'){
                        $class = 0;
                    }else{
                        $class = 1;
                    }
                }
                switch ($request->backup_type) {
                    case 'facesheet':
                        $repo = $this->facesheetManageRepository;
                        $instance = $this->sakurasetService->getFileInfoByReviewerId($repo,$request->member_id,'only',['id','file_name','display_name','member_id']);
                        break;
                    case 'initiative':
                        $repo = $this->initiativetableManageRepository;
                        $instance = $this->sakurasetService->getFileInfoByReviewerId($repo,$request->member_id,'only',['id','file_name','display_name','member_id']);
                        break;
                    default:
                        $repo = $this->reflectionsheetManageRepository;
                        $instance = $this->sakurasetService->getFileInfoByReviewerId($repo,['member_id' => $request->member_id, 'class' => $class],'only',['id','file_name','display_name','member_id']);
                        break;
                }
                $newFilename = $file->getClientOriginalName();
                // check old file exist
                if (file_exists($location . '/' . $instance->file_name)) {
                    $extension = pathinfo($instance->file_name, PATHINFO_EXTENSION);
                    $newFilenameWithoutExtension = pathinfo($instance->file_name, PATHINFO_FILENAME);
                    $namebk = $newFilenameWithoutExtension.'_bk.'.$extension;
                    rename($location . '/' . $instance->file_name, $location . '/' . $namebk);
                    // insert file backup to db
                    $this->sakurasetService->createBackupData($repo,$namebk,$instance->display_name,$request->member_id,$class);

                    $file->move($location,$newFilename);
                    // update new name for file
                    $instance->file_name = $newFilename;
                    $instance->save();
                    $msg = 'Change success';
                    $reviewer = $this->sakurasetService->getByLoggedId(['reviewer_id',$request->member_id],['reviewer_member','made_member']);
                    $emailConfig = ['to' => $reviewer->reviewer_member->email,'subject' => '[研修システム] お知らせ','sakuraData' => $reviewer->made_member];
                    $view = 'email.sakuraSet.backup_'.$request->backup_type;
                    if(!view()->exists($view)){
                        $msg = 'Template Email do not exist';
                    }else{
                        $status = Mail::send(new SendMail($view, $emailConfig));
                        if(!$status){
                            $msg = 'Send email failed';
                        }
                    }
                }

                $data['success'] = true;
                $data['message'] = $msg;
            }
        }
        return response()->json($data);
    }

    public function upload(Request $request)
    {
        if($request->get('type') == 'reflectionsheet'){
            $reflectionSheetId = $this->reflectionsheetManageService->upload($request);
        }else{
            $faceSheetId = $this->facesheetManageService->upload($request);
        }

        $data= [
          'success'=>false,
          'html' => ''
        ];

        if(!empty($faceSheetId)){
            $faceSheetManager = $this->facesheetManageService->getById($faceSheetId);
            $returnHTML = view('components/sub_popup_A013/data_upload',[
               'faceSheetManager'=>$faceSheetManager
            ])->render();
            $data['success'] = true;
            $data['html'] = $returnHTML;
        }elseif(!empty($reflectionSheetId)){
            $reflectionSheetManager = $this->reflectionsheetManageService->getById($reflectionSheetId);
            $returnHTML = view('components/sub_popup_A014/data_upload',[
                'reflectionSheetManager'=>$reflectionSheetManager
            ])->render();
            $data['success'] = true;
            $data['html'] = $returnHTML;
        }
        return response()->json($data);
    }

    public function updateShareFaceSheet(Request $request)
    {
        try {
            $id = $request->get('id');
            $shareFlg = $request->get('share_flg');
            $memberId = auth()->user()->id;
            $dataUpdate = [
                'share_flg' => $shareFlg
            ];

            //Update all share flag off when share = true
            if($shareFlg){
                $this->facesheetManageService->updateByMemberId($memberId,['share_flg' => 0]);
            }
            $data['update'] = $this->facesheetManageService->update($id, $dataUpdate);
            $data['success'] = true;
        } catch (Exception $e) {
            $data['success'] = false;
        }

        return response()->json($data);
    }

    public function updateShareReflectionSheet(Request $request)
    {
        try {
            $id = $request->get('id');
            $shareFlg = $request->get('share_flg');
            $memberId = auth()->user()->id;
            $dataUpdate = [
                'share_flg' => $shareFlg
            ];

            //Update all share flag off when share = true
            if($shareFlg){
                $this->reflectionsheetManageService->updateByMemberId($memberId,['share_flg' => 0]);
            }
            $data['update'] = $this->reflectionsheetManageService->update($id, $dataUpdate);
            $data['success'] = true;
        } catch (Exception $e) {
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function removeShareFaceSheet(Request $request)
    {
        try{
            $id = $request->get('id');
            $data['remove'] = $this->facesheetManageService->destroy($id);
            $data['success'] = true;
        }catch (Exception $e) {
            $data['success'] = false;
        }
        return response()->json($data);
    }

    public function sakuraRemoveReflectionSheet(Request $request)
    {
        try{
            $id = $request->get('id');
            $data['remove'] = $this->reflectionsheetManageService->destroy($id);
            $data['success'] = true;
        }catch (Exception $e) {
            $data['success'] = false;
        }
        return response()->json($data);
    }
}
