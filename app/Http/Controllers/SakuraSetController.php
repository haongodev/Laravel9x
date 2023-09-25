<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\GuidanceSettingService;
use App\Services\SakurasetService;
use App\Services\UserAddInfoService;
use App\Services\FacesheetManageService;
use App\Services\ReflectionsheetManageService;
use App\Services\InitiativetableManageService;
use App\Repositories\FacesheetManageRepository;
use App\Repositories\InitiativetableManageRepository;
use App\Repositories\ReflectionsheetManageRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMail;
use Carbon\Carbon;
use Exception;

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
     * @var InitiativetableManageService
     */
    protected $initiativetableManageService;

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
     * @param InitiativetableManageService $initiativetableManageService
     */
    public function __construct(
        GuidanceSettingService $guidanceSettingService,
        SakurasetService $sakurasetService,
        UserAddInfoService $userAddInfoService,
        FacesheetManageRepository $facesheetManageRepository,
        InitiativetableManageRepository $initiativetableManageRepository,
        ReflectionsheetManageRepository $reflectionsheetManageRepository,
        FacesheetManageService $facesheetManageService,
        ReflectionsheetManageService $reflectionsheetManageService,
        InitiativetableManageService $initiativetableManageService
    ){
        $this->guidanceSettingService = $guidanceSettingService;
        $this->sakurasetService = $sakurasetService;
        $this->userAddInfoService = $userAddInfoService;
        $this->facesheetManageRepository = $facesheetManageRepository;
        $this->initiativetableManageRepository = $initiativetableManageRepository;
        $this->reflectionsheetManageRepository = $reflectionsheetManageRepository;
        $this->facesheetManageService = $facesheetManageService;
        $this->reflectionsheetManageService = $reflectionsheetManageService;
        $this->initiativetableManageService = $initiativetableManageService;
    }
    public function loginId(){
        return auth()->user()->user_add_info->login_id;
    }

    public function index(Request $request)
    {
        $num_of_visit = 0;
        $session = $request->session();
        if($session->has('num_visit')){
            $session->remove('num_visit');
            $num_of_visit = 1;
        }else{
            $session->put('num_visit', 0);
        }
        $guidanceData = $this->guidanceSettingService->getByScreenId('A011',['location_id' => 1]);
        $with = [
            'made_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
            'reviewer_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
        ];
        $sakuraReviewManage = $this->sakurasetService->getByLoggedId(['reviewer_id',$this->loginId()],$with,true);
        $sakuraMemberManage = $this->sakurasetService->getByLoggedId(['member_id',$this->loginId()],$with);
        return view('myPage/sakuraSet/index',[
            'guidance' => $guidanceData,
            'sakuraReviewManage' => $sakuraReviewManage,
            'sakuraMemberManage' => $sakuraMemberManage,
            'num_of_visit' => $num_of_visit
        ]);
    }
    public function checkMark(Request $request){
        $loginId = $this->loginId();
        $status = true;
        
        $checkWithReviewer = $this->sakurasetService->getByLoggedId([['reviewer_id',$loginId],['reviewer_confirmation_flg',0]],null,true);
        if(count($checkWithReviewer->toArray()) > 0){
            $status = false;
        }
        $checkWithMember = $this->sakurasetService->getByLoggedId([['member_id',$loginId],['confirmation_flg',0]]);
        if($checkWithMember){
            $status = false;
        }

        return response()->json(['success' => true, 'status' => $status]);
    }
    public function unCheckMark(Request $request){
        $loginId = $this->loginId();
        
        $checkWithMember = $this->sakurasetService->getByLoggedId([['member_id',$loginId],['confirmation_flg',0]]);
        if($checkWithMember){
            $checkWithMember->confirmation_flg = 1;
            $checkWithMember->save();
        }

        $checkWithReviewer = $this->sakurasetService->getByLoggedId([['reviewer_id',$loginId],['reviewer_confirmation_flg',0]],null,true);
        if($checkWithReviewer){
            foreach($checkWithReviewer as $sakuraReviewer){
                $sakuraReviewer->reviewer_confirmation_flg = 1;
                $sakuraReviewer->save();
            }
        }
        return response()->json(['success' => true]);
    }
    public function update(Request $request){
        if(!$request->all()){
            return response()->json(['success' => false, 'data' => []]);
        }
        $dataUpdate = $request->except(['view','member_id']);
        $dataUpdate['confirmation_flg'] = 0;
        $dataUpdate['reviewer_confirmation_flg'] = 1;
        $member_id = $request->member_id;
        $reviewer_id = $this->loginId();
        $condition = [
            ['reviewer_id',$reviewer_id],
            ['member_id',$member_id],
        ];
        if($request->has('reviewer_status') && $request->reviewer_status == 3){
            $dataUpdate['reviewer_confirmation_flg'] = 0;
            $dataUpdate['confirmation_flg'] = 1;
            $condition = [
                ['reviewer_id',$member_id],
                ['member_id',$reviewer_id],
            ];
        }
        $with = [
            'made_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
            'reviewer_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
        ];
        $sakuraManage = $this->sakurasetService->getByLoggedId($condition,$with);
        $updateSakura = $this->sakurasetService->updateSakura($dataUpdate,$condition);
        $msg = '';
        if($updateSakura){
            $emailTo = $sakuraManage->reviewer_member->email;
            $subject = '生涯研修制度「研鑽管理システム」よりお知らせです。';
            switch ($request->reviewer_status) {
                case 2:
                    $subject = '「振り返り担当者」の申請が承認されました（自動送信メール）';
                    $emailTo = $sakuraManage->made_member->email;
                    break;
                case 3:
                    $subject = '「振り返り担当者」の解除申請がありました（自動送信メール）';
                    break;
                case 4:
                    $emailTo = $sakuraManage->made_member->email;
                    $subject = '生涯研修制度「研鑽管理システム」よりお知らせです。';
                    break;
            }
            $msg = 'Updated Successfully';
            $emailConfig = ['to' => $emailTo,'subject' => $subject,'sakuraData' => $sakuraManage];
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
        $member_id = $request->member_id;
        $sakuraManage = $this->sakurasetService->getByLoggedId([['reviewer_id',$this->loginId()],['member_id',$member_id]],['reviewer_member','made_member']);
        if($sakuraManage->reviewer_member){
            $emailConfig = ['to' => $sakuraManage->made_member->email,'subject' => '「振り返り担当者」の解除申請が承認されました（自動送信メール）','sakuraData' => $sakuraManage];
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
        $faceSheetManagerData = $this->facesheetManageService->getByUserId($this->loginId());
        $reflectionSheetManagerData = $this->reflectionsheetManageService->getByUserId($this->loginId());
        $initiativetableManagerData = $this->initiativetableManageService->getByUserId($this->loginId());

        return view('myPage/sakuraSet/yourTry',[
            'faceSheetManagerData' => $faceSheetManagerData,
            'reflectionSheetManagerData' => $reflectionSheetManagerData,
            'initiativetableManagerData' => $initiativetableManagerData,
        ]);
    }
    public function getSheet(Request $request){
        $member_id = $request->member_id;
        $reviewer = $this->sakurasetService->getReviewerbyMember($this->loginId(),$member_id);
        if($reviewer === null){
            return response()->json(['success' => false, 'message' => 'Reviewer do not exist','data' => []]);
        }
        $faceSheet = $this->sakurasetService->getFileInfoByReviewerId($this->facesheetManageRepository,$member_id,'only',['id','file_name','display_name','member_id']);
        $refSheet = $this->sakurasetService->getFileInfoByReviewerId($this->reflectionsheetManageRepository,$member_id,'list',['id','file_name','display_name','member_id','class']);
        $initTable = $this->sakurasetService->getFileInfoByReviewerId($this->initiativetableManageRepository,$member_id,'only',['id','file_name','display_name','member_id']);
        $data = [
            'facesheet' => $faceSheet,
            'reflectionsheet' => $refSheet,
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
                $location = 'storage/upload/'.$request->member_id.'/'.$request->backup_type;
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
                if($instance){
                    if (file_exists($location . '/' . $instance->file_name)) {
                        $extension = pathinfo($instance->file_name, PATHINFO_EXTENSION);
                        $newFilenameWithoutExtension = pathinfo($instance->file_name, PATHINFO_FILENAME);
                        $namebk = $newFilenameWithoutExtension.'_bk.'.$extension;
                        rename($location . '/' . $instance->file_name, $location . '/' . $namebk);
                        // insert file backup to db
                        $this->sakurasetService->createBackupData($repo,$namebk,$instance->display_name,$request->member_id,$class);
                        // update new name for file
                        $instance->file_name = $newFilename;
                        $instance->save();
                        $msg = 'Change success';
                    }
                }else{
                    $msg = 'Upload success';
                    $this->sakurasetService->createBackupData($repo,$newFilename,$newFilename,$request->member_id,$class);
                }
                // start upload file
                $file->move($location,$newFilename);
                // send email func
                $reviewer = $this->sakurasetService->getByLoggedId([['reviewer_id',$this->loginId()],['member_id',$request->member_id]],['reviewer_member','made_member']);
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
                $data['success'] = true;
                $data['message'] = $msg;
            }
        }
        return response()->json($data);
    }

    public function upload(Request $request)
    {
        $data= [
          'success'=>false,
          'html' => ''
        ];
        if($request->get('type') == 'reflectionsheet'){
            $reflectionSheetId = $this->reflectionsheetManageService->upload($request);
            if($reflectionSheetId){
                $reflectionSheetManager = $this->reflectionsheetManageService->getById($reflectionSheetId);
                $returnHTML = view('components/sub_popup_A014/data_upload',[
                    'reflectionSheetManager'=>$reflectionSheetManager
                ])->render();
                $data['success'] = true;
                $data['html'] = $returnHTML;
            }
        }elseif($request->get('type') == 'initiative'){
            $initiativetableId = $this->initiativetableManageService->upload($request);
            if($initiativetableId){
                $initiativetableManager = $this->initiativetableManageService->getById($initiativetableId);
                $returnHTML = view('components/sub_popup_A015/data_upload',[
                   'initiativetableManager'=>$initiativetableManager
                ])->render();
                $data['success'] = true;
                $data['html'] = $returnHTML;
            }
        }else{
            $faceSheetId = $this->facesheetManageService->upload($request);
            if($faceSheetId){
                $faceSheetManager = $this->facesheetManageService->getById($faceSheetId);
                $returnHTML = view('components/sub_popup_A013/data_upload',[
                   'faceSheetManager'=>$faceSheetManager
                ])->render();
                $data['success'] = true;
                $data['html'] = $returnHTML;
            }
        }
        return response()->json($data);
    }

    public function updateShareFaceSheet(Request $request)
    {
        try {
            $id = $request->get('id');
            $shareFlg = $request->get('share_flg');
            $dataUpdate = [
                'share_flg' => $shareFlg
            ];

            //Update all share flag off when share = true
            if($shareFlg){
                $this->facesheetManageService->updateByMemberId($this->loginId(),['share_flg' => 0]);
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
            $dataUpdate = [
                'share_flg' => $shareFlg
            ];

            //Update all share flag off when share = true
            if($shareFlg){
                $this->reflectionsheetManageService->updateByMemberId($this->loginId(),['share_flg' => 0]);
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

    public function sakuraRemoveInitiativeTable(Request $request){
        try{
            $id = $request->get('id');
            $data['remove'] = $this->initiativetableManageService->destroy($id);
            $data['success'] = true;
        }catch (Exception $e) {
            $data['success'] = false;
        }
        return response()->json($data);
    }
    public function updateShareInitiativeTable(Request $request){
        try {
            $id = $request->get('id');
            $shareFlg = $request->get('share_flg');
            $dataUpdate = [
                'share_flg' => $shareFlg
            ];

            //Update all share flag off when share = true
            if($shareFlg){
                $this->initiativetableManageService->updateByMemberId($this->loginId(),['share_flg' => 0]);
            }
            $data['update'] = $this->initiativetableManageService->update($id, $dataUpdate);
            $data['success'] = true;
        } catch (Exception $e) {
            $data['success'] = false;
        }

        return response()->json($data);
    }
    public function updateScheduled(Request $request)
    {
        $data['success'] = false;
        $data['message'] = 'Sakuraset do not exist';
        if(!$request->has('scheduled')){
            return response()->json($data);
        }
        try{
            $date = Carbon::parse($request->scheduled)->format('Y-m-d H:i:s');
            if($this->sakurasetService->updateSchedule($date)){
                $data['success'] = true;
            }
        }catch (Exception $e) {
            $data['success'] = false;
        }
        return response()->json($data);
    }
    public function registerReviewer(){
        $with = [
            'made_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
            'reviewer_member' => function ($query) {
                $query->select('id', 'users_id', 'login_id', 'name1', 'name2', 'email');
            },
        ];
        $sakuraReviewManage = $this->sakurasetService->getByLoggedId(['reviewer_id',$this->loginId()],$with,true);
        $sakuraMemberManage = $this->sakurasetService->getByLoggedId(['member_id',$this->loginId()],$with);
        return view('myPage/sakuraSet/registerReviewer',[
            'sakuraReviewManage' => $sakuraReviewManage,
            'sakuraMemberManage' => $sakuraMemberManage,
        ]);
    }
    public function searchMemberToReview(Request $request){
        $dataAll = $request->all();
        $member = $this->userAddInfoService->getMemberToReview($dataAll);
        $result = [];
        $data['success'] = false;
        if(count($member) > 1){
            $member = $member->toArray();
            $filteredData = array_filter($member, function ($item) use ($dataAll) {
                return strpos($item['name1'], $dataAll['last_name']) !== false;
            });
            $result = array_values($filteredData);
            if(count($result) > 1){
                $result = $result[0];
            }
            $data['data'] = $result;
            $data['success'] = true;
        }else{
            if(count($member) === 0){
                $data['success'] = false;
            }else{
                $data['success'] = true;
            }
            $data['data'] = $member->toArray();
        }
        return response()->json($data);
    }
    public function addMemberToReview(Request $request){
        $dataAll = $request->all();
        $data['success'] = false;
        $sakuraManage = $this->sakurasetService->getByLoggedId(['member_id',$this->loginId()],'made_member');
        if($sakuraManage){
            $sakuraManage->update([
                'reviewer_id' => $dataAll['member_id'],
                'reviewer_status' => 1,
                'confirmation_flg' => 1,
                'reviewer_confirmation_flg' => 0
            ]);
            $data['success'] = true;
        }else{
            $data['success'] = true;
            $sakuraManage = $this->sakurasetService->createSakura([
                'member_id' => $this->loginId(),
                'reviewer_id' => $dataAll['member_id'],
                'reviewer_status' => 1,
                'confirmation_flg' => 1,
                'reviewer_confirmation_flg' => 0
            ]);
        }
        $emailConfig = ['to' => $dataAll['email'],'subject' => '「振り返り担当者」の申請がありました（自動送信メール）','sakuraData' => $sakuraManage];
        $view = 'email.sakuraSet.registerReviewer';
        if(!view()->exists($view)){
            $data['message'] = 'Template Email do not exist';
        }else{
            $status = Mail::send(new SendMail($view, $emailConfig));
            if(!$status){
                $data['message'] = 'send email failed';
            }
        }
        return response()->json($data);
    }
}
