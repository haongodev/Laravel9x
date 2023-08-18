<?php

namespace App\Services;

use App\Repositories\FacesheetManageRepository;

class FacesheetManageService
{
    /**
     * @var FacesheetManageRepository
     */
    protected $facesheetManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param FacesheetManageRepository $facesheetManageRepository
     */
    public function __construct(FacesheetManageRepository $facesheetManageRepository)
    {
        $this->facesheetManageRepository = $facesheetManageRepository;
    }

    public function upload($request)
    {
        if ($request->hasFile('file')) {
            $memberId = auth()->user()->id;
            $name = $request->file('file')->getClientOriginalName();
            $file = explode('.',$name);
            $fileName = $file[0];
            $fileType = $file[1];
            $fileName = $this->generateFileName($fileName, $fileType,1);
            $name = $fileName.'.'.$fileType;
            $path = $request->file('file')->storeAs($memberId.'/facesheet', $name,'sakura');
            $data = [
                'member_id' => $memberId,
                'file_name' => $name,
                'display_name' => date('Y年 m月 d日'),
                'share_flg' => 0,
                'delete_date' => null
            ];
            $data = $this->facesheetManageRepository->store($data);
            return $data;
        }
    }

    /**
     * Generate number when exist file name
     * */
    private function generateFileName($fileName,$fileType, $index = 1)
    {
        $memberId = auth()->user()->id;
        if(file_exists(public_path('/storage/upload/'.$memberId.'/facesheet/'.$fileName.'.'.$fileType))) {
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
    public function getByUserId($userId = 0)
    {
        return $this->facesheetManageRepository->getByUserId($userId);
    }

    public function update($id =0 , $data = [])
    {
        return $this->facesheetManageRepository->update($id, $data);
    }

    public function updateByMemberId($memberId = 0, $data = [])
    {
        return $this->facesheetManageRepository->updateByMemberId($memberId, $data);
    }

    public function destroy($id = 0)
    {
        return $this->facesheetManageRepository->destroy($id);
    }
}
