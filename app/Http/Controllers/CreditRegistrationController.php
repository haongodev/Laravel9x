<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CreditRegistrationController extends Controller
{
    public function index()
    {
        return view('myPage/creditRegistration/index');
    }

    public function registry()
    {
        return view('myPage/creditRegistration/registry');
    }
}
