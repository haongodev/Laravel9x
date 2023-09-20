<?php

namespace App\Repositories;


use App\Models\AnswerManage;
use Illuminate\Support\Facades\DB;

class AnswerManageRepository
{
    protected $model;

    public function __construct(AnswerManage $model)
    {
        $this->model = $model;
    }

    public function getRegistrationYearByTypeNativeId($typeNativeId = 0)
    {
        $memberId = auth()->user()->id ?? '';
        $result = $this->model
            ->join('answer_info', function ($q) {
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })->where('member_id',$memberId);
        if (is_array($typeNativeId)){
            $result = $result->whereIn('answer_manage.type_native_id',$typeNativeId);
        }else{
            $result = $result->where('answer_manage.type_native_id',$typeNativeId);
        }
        return $result->groupBy('registration_year')->pluck('registration_year');
    }
    public function sumCoreCredits($year){
        $memberId = auth()->user()->id;
        if(is_array($year)){
            if($year[0] != 0 && $year[1] !==0){
                if($year[0] > $year[1]){
                    $year = [$year[1],$year[0]];
                }
                $years = [];
                for ($i = $year[0]; $i <= $year[1]; $i++) {
                    $years[] = $i;
                }
                $year = $years;
            }
        }
        $result = $this->model
            ->join('answer_info', function ($q) use ($year){
                $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
            })
            ->where('member_id', $memberId)
            ->whereIn('answer_manage.type_native_id', [0,1,2]);
        if(is_array($year)){
            $result = $result->whereIn('registration_year',$year);
        }else{
            $result = $result->where('registration_year',$year);
        }
        $result = $result->groupBy('answer_manage.type_native_id')->select('answer_manage.type_native_id', \DB::raw('SUM(score) as total_score'))->get();
        return $result;
    }
    public function sumCoreBwYear($from,$to){
        $date = [$from,$to];
        $memberId = auth()->user()->id;
        return $this->model
        ->join('answer_info', function ($q){
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
        ->select('answer_manage.registration_year','answer_manage.type_native_id', \DB::raw('SUM(answer_info.score) as total_score'))
        ->where('answer_manage.member_id', $memberId)
        ->where(function ($q) use($date) {
            $q->where('answer_info.effective_date_flg', 1)
              ->whereBetween('answer_info.answer', [$date[0],$date[1]]);
        })
        ->whereIn('answer_manage.type_native_id', [0,1,2])
        ->groupBy('answer_manage.registration_year','answer_manage.type_native_id')->get();
    }
    public function sumCoreBwYearGoalStudy($from,$to){
        $memberId = auth()->user()->id;
        $date = [$from,$to];
        return $this->model
        ->join('answer_info', function ($q){
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
        ->select('answer_info.title','answer_info.answer','answer_manage.registration_year', \DB::raw('SUM(answer_info.score) as total_score'))
        ->where('answer_manage.member_id', $memberId)
        ->whereIn('answer_manage.type_native_id', [0,1,2])
        ->where('answer_info.title', 'like', '%研鑽目的%')
        ->where(function ($q) use($date) {
            $q->where('answer_info.effective_date_flg', 1)
              ->whereBetween('answer_info.answer', [$date[0],$date[1]]);
        })
        ->whereBetween('answer_manage.registration_date',[$from,$to])
        ->groupBy('answer_manage.registration_year','answer_info.answer','answer_info.title')->get();
    }
    public function sumScoreBwYearForPattern($from,$to){
        $memberId = auth()->user()->id;
        $date = [$from,$to];
        return $this->model
        ->join('answer_info', function ($q){
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
        ->select('answer_info.effective_date_flg','answer_info.disp_flg','answer_info.title','answer_info.answer','answer_manage.registration_year','answer_manage.type_native_id')
        ->where('answer_manage.member_id', $memberId)
        ->whereIn('answer_manage.type_native_id', [0,1,2])
        ->where(function ($q) {
            $q->where('answer_info.effective_date_flg', 1)
              ->orWhere('answer_info.disp_flg', 1);
        })
        ->where(function ($q) use($date) {
            $q->where('answer_info.effective_date_flg', 1)
              ->whereBetween('answer_info.answer', [$date[0],$date[1]]);
        })
        ->orderBy('answer_manage.type_native_id', 'ASC')->orderBy('answer_manage.registration_year', 'ASC')->get();
    }
    public function getLastId()
    {
        return $this->model->orderBy('id', 'DESC')->get()->pluck('id')->first();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function getById($id = 0)
    {
        return $this->model->where('id',$id)->get()->first();
    }

    public function checkViewVideo($typeNativeId = 0, $condition = [])
    {
        $answerVideo = $condition['answerVideo'] ?? [];
        $registerYear = $condition['registerYear'] ?? 0;
        $memberId = auth()->user()->id;
        return  $this->model->join('answer_info', function ($q) {
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
            ->where('answer_manage.type_native_id',$typeNativeId)
            ->where('answer_manage.member_id',$memberId)
            ->where('answer_info.viewing_check_flg',1)
            ->where('answer_manage.registration_year',$registerYear)
            ->whereIn('answer_info.answer',$answerVideo)->get()->first();
        ;
    }
}
