<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\FacesheetManageRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Validator;

class FaceSheetController extends Controller
{
    /**
     * @var FacesheetManageRepository
     */
    protected $facesheetManageRepository;

    /**
     * SakuraSet constructor.
     * @param FacesheetManageRepository $facesheetManageRepository
     */
    public function __construct(
        FacesheetManageRepository $facesheetManageRepository){
        $this->facesheetManageRepository = $facesheetManageRepository;
    }
}