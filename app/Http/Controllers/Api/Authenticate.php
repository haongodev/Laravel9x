<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class Authenticate
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(LoginApiRequest $request)
    {

        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended('/mypage');

    }

    public function getUrl(Request $request)
    {
        $memberId = $request->get('membership_no');
        $token = $request->bearerToken();

        $user = $this->userService->getByLoginId($memberId);
        $tokenUser = md5($user->login_id ?? '');
        if ($token == $tokenUser) {
            $url =  route('api_login',['id'=>$user->users_id, 'token'=>$user->password]);
            return response()->json(['url' => $url]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
