<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Authenticate
{
    public function login(LoginApiRequest $request)
    {

        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended('/mypage');

    }

    public function getUrl(Request $request)
    {
        $id = $request->get('id');
        $token = $request->bearerToken();

        $user = User::where('id', $id)->get()->first();
        $tokenUser = md5($user->user_add_info->member_id ?? '');
        if ($token == $tokenUser) {
            $url =  route('api_login',['id'=>$id, 'token'=>$user->password]);
            return response()->json(['url' => $url]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
