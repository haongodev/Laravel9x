<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function index(LoginApiRequest $request)
    {

        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);

    }

    public function getToken(Request $request)
    {
                $id = $request->get('id');
        $token = $request->bearerToken();
        $hashedPasswordFromDb = User::where('id', $id)->first()->api_token ?? '';
// So sánh mã băm từ yêu cầu với mã băm lưu trong CSDL
//        if ($token == $hashedPasswordFromDb) {
        return response()->json(['token' => $token]);
//        } else {
        return response()->json(['message' => 'Unauthorized'], 401);
//        }
    }
}
