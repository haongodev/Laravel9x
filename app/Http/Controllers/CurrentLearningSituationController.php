<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AnswerManageService;
use App\Services\AnswerInfoService;
use App\Services\GuidanceSettingService;
use Illuminate\Http\Request;

class CurrentLearningSituationController extends Controller
{
    
    /**
     * @var GuidanceSettingService
     */
    protected $guidanceSettingService;
    /**
     * @var AnswerManageService
     */
    protected $answerManageService;
    /**
     * @var AnswerInfoService
     */
    protected $answerInfoService;

    /**
     * CurrentLearningSituationController constructor.
     * @param AnswerManageService $answerManageService
     * @param GuidanceSettingService $guidanceSettingService
     * @param AnswerInfoService $answerInfoService
     */
    public function __construct(
        AnswerManageService $answerManageService,
        GuidanceSettingService $guidanceSettingService,
        AnswerInfoService $answerInfoService){
        $this->answerManageService = $answerManageService;
        $this->guidanceSettingService = $guidanceSettingService;
        $this->answerInfoService = $answerInfoService;
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $registrationYearData = $this->answerManageService->getRegistrationYearByTypeNativeId([0,1,2]);
        $year_list = $registrationYearData->toArray();
        
        $year_now = intval(date("Y"));
        if(!in_array($year_now,$year_list)){
            array_push($year_list,$year_now);
        }
        $guidanceData = $this->guidanceSettingService->getByScreenId('A009',['location_id' => 1]);
        $sumCoreByInitYear = $this->answerManageService->getSumCoreByTypeNativeId(last($year_list));
        $year_range = [getCertificationYear(),intval(date('Y'))];
        $sumCoreByInitYearRange = $this->answerManageService->getSumCoreByTypeNativeId($year_range);
        return view('myPage/currentLearningSituation/index',[
                                                                'year_list' => array_reverse($year_list),
                                                                'guidance' => $guidanceData, 
                                                                'sumCoreByInitYear' => $sumCoreByInitYear,
                                                                'sumCoreByInitYearRange' => $sumCoreByInitYearRange,
                                                            ]);
    }
    public function getSumCoreByYear($year)
    {
        $sumCoreByInitYear = $this->answerManageService->getSumCoreByTypeNativeId($year);
        return response()->json( array('success' => true, 'data' => $sumCoreByInitYear) );
    }
    public function getStudyScoreBwMonth($date){
        $date = explode('_',$date);
        $from = $date[0];
        $to = $date[1];
        $getScoreBwYear = $this->answerManageService->getSumCoreBwYear($from,$to);
        return response()->json( array('success' => true, 'data' => ['scoreBwYear' => $getScoreBwYear]) );
    }
}
