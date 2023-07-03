<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CurrentLearningSituationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('myPage/currentLearningSituation/index');
    }

}
