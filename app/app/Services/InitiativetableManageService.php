<?php

namespace App\Services;

use App\Repositories\InitiativetableManageRepository;
use Carbon\Carbon;

class InitiativetableManageService
{
    /**
     * @var InitiativetableManageRepository
     */
    protected $initiativetableManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param InitiativetableManageRepository $initiativetableManageRepository
     */
    public function __construct(InitiativetableManageRepository $initiativetableManageRepository)
    {
        $this->initiativetableManageRepository = $initiativetableManageRepository;
    }
    
    public function upload($request)
    {
        if ($request->hasFile('file')) {
            $memberId = auth()->user()->user_add_info->login_id;
            $name = $request->file('file')->getClientOriginalName();
            $file = explode('.',$name);
            $fileName = $file[0];
            $fileType = $file[1];
            $fileName = $this->generateFileName($fileName, $fileType,1);
            $name = $fileName.'.'.$fileType;
            $path = $request->file('file')->storeAs($memberId.'/initiative', $name,'sakura');
            $data = [
                'member_id' => $memberId,
                'file_name' => $name,
                'display_name' => date('Y年 m月 d日'),
                'share_flg' => 0,
                'delete_date' => null,
                'registration_date' => Carbon::now(),
                'update_date' => Carbon::now()
            ];
            $id = $this->initiativetableManageRepository->insertGetId($data);
            return $id;
        }
    }
    /**
     * Generate number when exist file name
     * */
    private function generateFileName($fileName,$fileType, $index = 1)
    {
        $memberId = auth()->user()->user_add_info->login_id;
        if(file_exists(public_path('/storage/upload/'.$memberId.'/initiative/'.$fileName.'.'.$fileType))) {
            if($index == 1){
                $fileName = $fileName.' ('.$index.')';
            }else{
                $preIndex = $index-1;
                $fileName = str_replace('('.$preIndex.')','('.$index.')',$fileName);
            }

            return $this->generateFileName($fileName,$fileType, $index+1);
        }
        return $fileName;
    }
    public function update($id =0 , $data = [])
    {
        return $this->initiativetableManageRepository->update($id, $data);
    }
    public function getById($id = 0)
    {
        return $this->initiativetableManageRepository->getById($id);
    }
    public function getByUserId($userId = 0)
    {
        return $this->initiativetableManageRepository->getByUserId($userId);
    }
    public function updateByMemberId($memberId = 0, $data = [])
    {
        return $this->initiativetableManageRepository->updateByMemberId($memberId, $data);
    }
    public function destroy($id = 0)
    {
        return $this->initiativetableManageRepository->destroy($id);
    }
}
