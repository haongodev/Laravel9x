<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function detail(Request $request, $loginId)
    {
        $member = $this->memberService->getByLoginId($loginId);
        return view('admin.member.detail', ['member' => $member]);
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

}
