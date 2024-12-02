<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\InitiativetableManageRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendMail;

class InitiativetableController extends Controller
{
    /**
     * @var InitiativetableManageRepository
     */
    protected $initiativetableManageRepository;

    /**
     * SakuraSet constructor.
     * @param InitiativetableManageService $initiativetableManageService
     */
    public function __construct(
        InitiativetableManageRepository $initiativetableManageRepository){
        $this->initiativetableManageRepository = $initiativetableManageRepository;
    }
}