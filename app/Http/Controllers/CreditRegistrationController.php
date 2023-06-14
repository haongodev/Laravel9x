<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CreditRegistrationController extends Controller
{
    public function index()
    {
        return view('myPage/creditRegistration/index');
    }

    public function typeSelected()
    {
        return view('myPage/creditRegistration/typeSelected');
    }

    public function creditRegistry(Request $request)
    {
        return view('myPage/creditRegistration/registry');
    }
    public function handleCreditRegistry(Request $request){
        /* show confirm */
        if ($request->has('confirm')){
            Session::put('popup_confirm', $request->except(['_token','confirm']));
            return redirect()->route('creditRegistry');
        }else{
            if(Session::get('popup_confirm')){
                /* handle with database here */
                Session::forget('popup_confirm');
                return response()->json(['message' => 'successfully']);
            }
        }
    }
}
