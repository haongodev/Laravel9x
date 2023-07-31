<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ReflectionsheetManageRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\SendMail;

class ReflectionsheetController extends Controller
{
    /**
     * @var ReflectionsheetManageRepository
     */
    protected $reflectionsheetManageRepository;

    /**
     * SakuraSet constructor.
     * @param ReflectionsheetManageRepository $reflectionsheetManageRepository
     */
    public function __construct(
        ReflectionsheetManageRepository $reflectionsheetManageRepository){
        $this->reflectionsheetManageRepository = $reflectionsheetManageRepository;
    }
}