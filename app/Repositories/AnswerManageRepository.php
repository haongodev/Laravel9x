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
        $possibleTypes = [0, 1, 2];
        $tacy = intval(auth()->user()->user_add_info->training_accreditation_certification_year);
        $tacyold = $tacy - 4;
        $allTypes = collect($possibleTypes)->map(function ($type) {
            return ['type_native_id' => $type];
        });
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
        // Truy vấn dữ liệu
        $result = $this->model
                ->leftJoin('answer_info', function ($q) use ($year) {
                    $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
                })
                ->where('member_id', $memberId)
                ->whereIn('answer_manage.type_native_id', $possibleTypes);

        if (is_array($year)) {
            $result->whereIn('registration_year', $year);
        } else {
            $result->whereBetween('registration_year', [$tacyold,$tacy]);
        }

        $result = $result
                ->groupBy('answer_manage.type_native_id')
                ->orderBy('answer_manage.type_native_id', 'asc')
                ->select(
                    'answer_manage.type_native_id',
                    \DB::raw('COALESCE(SUM(score), 0) as total_score')
                )
                ->get();

                // Kết hợp kết quả với bảng tạm thời
        $result = $allTypes->map(function ($type) use ($result) {
            $match = $result->where('type_native_id', $type['type_native_id'])->first();
            return [
                    'type_native_id' => $type['type_native_id'],
                    'total_score' => $match ? $match['total_score'] : 0,
            ];
        });
        return $result;
    }
    public function sumCoreBwYear($from,$to){
        $date = [$from, $to];
        $memberId = auth()->user()->id;
        return $this->model
            ->leftJoin('answer_info as ai',function($q){
                $q->on('answer_manage.id','=','ai.answer_manage_id');
            })
            ->join('answer_info as ai2',function ($q){
                $q->on('answer_manage.id','=','ai2.answer_manage_id');
            })
            ->select('answer_manage.registration_year', 'answer_manage.type_native_id', \DB::raw('SUM(ai.score) as total_score'))
            ->where('answer_manage.member_id', $memberId)
            ->whereIn('answer_manage.type_native_id', [0, 1, 2])
            ->where('ai2.effective_date_flg',1)
            ->where(function ($q) use ($date){
                $q->whereBetween('ai2.answer',[$date[0],$date[1]])
                    ->orWhere(function ($q2) use ($date){
                        $yearStart = date('Y',strtotime($date[0]));
                        $yearEnd = date('Y',strtotime($date[1]));
                        $q2->where('ai2.input_method',10)
                            ->whereBetween('ai2.answer',[$yearStart,$yearEnd]);
                    })
                ;
            })
            ->groupBy('answer_manage.registration_year', 'answer_manage.type_native_id')->get();

    }
    public function sumCoreBwYearGoalStudy($from,$to){
        $memberId = auth()->user()->id;
        $date = [$from,$to];
        return $this->model
            ->leftJoin('answer_info as ai', function ($q){
                $q->on('answer_manage.id', '=', 'ai.answer_manage_id');
            })
            ->join('answer_info as ai2', function ($q){
                $q->on('answer_manage.id', '=', 'ai2.answer_manage_id');
            })
            ->select('ai.answer','answer_manage.registration_year')
            ->where('answer_manage.member_id', $memberId)
            ->whereIn('answer_manage.type_native_id', [0,1,2])
            ->where('ai.title', 'like', '%研鑽目的%')
            ->where('ai2.effective_date_flg',1)
            ->where(function ($q) use ($date){
                $q->whereBetween('ai2.answer',[$date[0],$date[1]])
                    ->orWhere(function ($q2) use ($date){
                        $yearStart = date('Y',strtotime($date[0]));
                        $yearEnd = date('Y',strtotime($date[1]));
                        $q2->where('ai2.input_method',10)
                            ->whereBetween('ai2.answer',[$yearStart,$yearEnd]);
                    })
                ;
            })
            ->groupBy('ai.answer','answer_manage.registration_year')->get();

    }
    public function sumScoreBwYearForPattern($from,$to){
        $memberId = auth()->user()->id;
        $date = [$from,$to];
        return $this->model
            ->leftJoin('answer_info as ai', function ($q){
                $q->on('answer_manage.id', '=', 'ai.answer_manage_id');
            })
            ->join('answer_info as ai2', function ($q){
                $q->on('answer_manage.id', '=', 'ai2.answer_manage_id');
            })
            ->select(
                'answer_manage.registration_year',
                'answer_manage.type_native_id',
                DB::raw('ai2.answer as date'),
                DB::raw('ai.answer as answer'),
            )
            ->where('answer_manage.member_id', $memberId)
            ->whereIn('answer_manage.type_native_id', [0,1,2])
            ->where('ai.disp_flg', 1)
            ->where('ai2.effective_date_flg',1)
            ->where(function ($q) use ($date){
                $q->whereBetween('ai2.answer',[$date[0],$date[1]])
                    ->orWhere(function ($q2) use ($date){
                        $yearStart = date('Y',strtotime($date[0]));
                        $yearEnd = date('Y',strtotime($date[1]));
                        $q2->where('ai2.input_method',10)
                            ->whereBetween('ai2.answer',[$yearStart,$yearEnd]);
                    })
                ;
            })
            ->orderBy('answer_manage.type_native_id', 'ASC')->orderBy('answer_manage.registration_year', 'ASC')->get()
            ;
        return $this->model
        ->leftJoin('answer_info', function ($q){
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
        ->select('answer_info.effective_date_flg','answer_info.disp_flg','answer_info.title','answer_info.answer','answer_manage.registration_year','answer_manage.type_native_id')
        ->where('answer_manage.member_id', $memberId)
        ->whereIn('answer_manage.type_native_id', [0,1,2])
        ->where('answer_info.disp_flg', 1)
        ->whereIn('answer_manage.id', function ($q) use ($date){
            $q->select('ai2.answer_manage_id')->from('answer_info as ai2')
                ->where('ai2.effective_date_flg', 1)
                ->where(function ($q2) use($date){
                    $q2->where(function($q3) use ($date){
                        $q3->whereIn('ai2.input_method',[7,8])
                            ->whereBetween('ai2.answer',[$date[0],$date[1]]);
                    })
                        ->orWhere(function ($q4) use ($date){
                            $yearStart = date('Y',strtotime($date[0]));
                            $yearEnd = date('Y',strtotime($date[1]));
                            $q4->where('ai2.input_method',10)
                                ->whereBetween('ai2.answer',[$yearStart,$yearEnd]);
                        });
                });
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

    public function checkViewVideo($typeNativeId = 0, $condition = [], $action = 'add')
    {
        $answerVideo = $condition['answerVideo'] ?? [];
        $registerYear = $condition['registerYear'] ?? 0;
        $memberId = auth()->user()->id;
        $query =  $this->model->join('answer_info', function ($q) {
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
            ->where('answer_manage.type_native_id',$typeNativeId)
            ->where('answer_manage.member_id',$memberId)
            ->where('answer_info.viewing_check_flg',1)
            ->where('answer_manage.registration_year',$registerYear)
            ->whereIn('answer_info.answer',$answerVideo);
        if($action=='edit'){
            $answerManageId = $condition['answerManageId'] ?? 0;
            $query->where('answer_info.answer_manage_id','!=',$answerManageId);
        }
        return $query->get()->first();
    }

    public function checkViewOption()
    {
        $memberId = auth()->user()->id;
        return $this->model->join('answer_info', function ($q) {
            $q->on('answer_manage.id', '=', 'answer_info.answer_manage_id');
        })
        ->where('answer_manage.member_id',$memberId)
        ->where('answer_info.answer', 'like', '%本協会作成のSV動画を視聴する%')
            ->get();
            ;
    }

    public function countAnswer(){
        return $this->model->distinct('member_id')->count('member_id');
    }
}
