<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use App\Services\FacesheetManageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    protected $memberService;
    protected $facesheetManageService;

    public function __construct(
        MemberService $memberService,
        FacesheetManageService $facesheetManageService
    )
    {
        $this->memberService = $memberService;
        $this->facesheetManageService = $facesheetManageService;
    }

    public function detail(Request $request, $loginId)
    {
        $member = $this->memberService->getByLoginId($loginId);
        if(!$member){
            abort(404);
        }
        return view('admin.member.detail', ['member' => $member]);
    }

    public function listFile(Request $request, $loginId)
    {
        $member = $this->memberService->getByLoginId($loginId);
        if(!$member){
            abort(404);
        }
        $fileUploadData = $this->facesheetManageService->getAllTypeFileUploadByMemberId($member->login_id)->paginate(15);
        return view('admin.member.list_file', ['member' => $member,'fileUploadData' => $fileUploadData]);
    }

    public function changePassWord(Request $request)
    {
        $response = ['success'=>true, 'message' => ''];
        $password = $request->get('password');
        $passwordConfirm = $request->get('password_confirm');

        //Validate
        if($password != $passwordConfirm){
            $response['message'] = 'パスワードとパスワード（確認用）が異なっています。';
        }else if($password == '' && $passwordConfirm == ''){
            $response['message'] = 'パスワードを入力して下さい';

        }
        if($response['message']){
            return response()->json($response);
        }

        $userId = auth()->user()->id;
        $data = $this->memberService->updatePassWord($userId,$password);
        if(!$data){
            $response['success'] = false;
        }
        return response()->json($response);
    }

    public function userManage(Request $request)
    {
        $userData = $this->memberService->getUserManage($request->all())->paginate(15);
        return view('admin.member.user.index',['userData'=>$userData]);
    }

    public function userRegistration(Request $request)
    {
        return view('admin.member.user.registration');
    }

    public function userPostRegistration(Request $request)
    {
        $response = ['success'=>true, 'message' => ''];
        $password = $request->get('password');
        $passwordConfirm = $request->get('password_confirm');
        //Validate
        if($password != $passwordConfirm){
            $response['message'] = 'パスワードとパスワード（確認用）が異なっています。';
        }else if($password == '' && $passwordConfirm == ''){
            $response['message'] = 'パスワードを入力して下さい';
        }
        if($response['message']){
            return response()->json($response);
        }
    }
    
    public function userDetail($userId = '')
    {
        Session::forget('manage_user_add_info');
        $user = $this->memberService->getUserManageByUserId($userId);
        if (!$user) {
            abort(404);
        }
        return view('admin.member.user.detail', ['user' => $user]);
    }

    public function userEdit($userId = '')
    {
        $user = Session::get('manage_user_add_info');
        if (!$user) {
            $user = $this->memberService->getUserManageByUserId($userId);
        }
        if (!$user) {
            abort(404);
        }
        return view('admin.member.user.edit', ['user' => $user]);
    }

    public function userEditConfirm(Request $request, $loginId)
    {
        $user = $request->except('_token');
        $user = (object)$user;
        Session::put('manage_user_add_info', $user);
        return view('admin.member.user.confirm', ['user' => $user, 'loginId' => $loginId]);
    }

    public function userUpdate(Request $request, $userId)
    {
        $data = $request->all();
        $response = ['success' => true];
        $user = $this->memberService->updateUserManage($userId, $data);
        if (!$user) {
            $response['success'] = false;
        }
        Session::forget('manage_user_add_info');
        return response()->json($response);
    }

    public function userDelete(Request $request)
    {
        $userId = $request->get('user_id');
        $response = ['success' => true];
        $user = $this->memberService->deleteUserManageByUserId($userId);
        if (!$user) {
            $response['success'] = false;
        }
        return response()->json($response);
    }

}
