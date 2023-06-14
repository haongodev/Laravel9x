<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\GuidanceSettingService;

class CreditRegistrationController extends Controller
{
    /**
     * @var GuidanceSettingService
     */
    protected $guidanceSettingService;

    /**
     * MyPageController constructor.
     * @param GuidanceSettingService $guidanceSettingService
     */
    public function __construct(GuidanceSettingService $guidanceSettingService)
    {
        $this->guidanceSettingService = $guidanceSettingService;
    }
    public function index()
    {
        $guidanceData = $this->guidanceSettingService->getByScreenId('A002');
        return view('myPage/creditRegistration/index',['guidanceData'=>$guidanceData]);
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
