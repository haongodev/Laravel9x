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

    public function getToken(Request $request)
    {
        $id = $request->get('id');
        $token = $request->bearerToken();

        $tokenLogin = Str::random(32);
        $user = User::where('id', $id)->get()->first();
        $tokenUser = $user->api_token ?? '';
        if ($token == $tokenUser) {
            return response()->json(['token' => $tokenLogin]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
