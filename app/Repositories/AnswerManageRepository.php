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
            if($year[0] > $year[1]){
                $year = [$year[1],$year[0]];
            }
            $years = [];
            for ($i = $year[0]; $i <= $year[1]; $i++) {
                $years[] = $i;
            }
            $year = $years;
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
}
