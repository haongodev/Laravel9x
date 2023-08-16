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

    public function getByUserId($userId = 0)
    {
        return $this->facesheetManageRepository->getByUserId($userId);
    }
}
