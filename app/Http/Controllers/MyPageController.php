<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class MyPageController extends Controller
{
    public function index()
    {
        return view('myPage');
    }

}
