<?php

namespace App\Services;

use App\Repositories\ReflectionsheetManageRepository;
use Carbon\Carbon;

class ReflectionsheetManageService
{
    /**
     * @var ReflectionsheetManageRepository
     */
    protected $reflectionsheetManageRepository;

    /**
     * GuidanceSettingService constructor.
     * @param ReflectionsheetManageRepository $reflectionsheetManageRepository
     */
    public function __construct(ReflectionsheetManageRepository $reflectionsheetManageRepository)
    {
        $this->reflectionsheetManageRepository = $reflectionsheetManageRepository;
    }

    public function upload($request)
    {
        if ($request->hasFile('file')) {
            $memberId = auth()->user()->user_add_info->login_id;
            $class = $request->get('class');
            $pathClass = $class == 2 ? 'at' : ($class == 1 ? '12m' : '6m');
            $name = $request->file('file')->getClientOriginalName();
            $file = explode('.', $name);
            $fileName = $file[0];
            $fileType = $file[1];
            $fileName = $this->generateFileName($fileName, $fileType, $pathClass, 1);
            $name = $fileName . '.' . $fileType;
            $path = $request->file('file')->storeAs($memberId . '/reflectionsheet/' . $pathClass . '/', $name, 'sakura');
            $data = [
                'member_id' => $memberId,
                'class' => $class,
                'file_name' => $name,
                'display_name' => date('Y年 m月 d日'),
                'share_flg' => 0,
                'delete_date' => null,
                'registration_date' => Carbon::now(),
                'update_date' => Carbon::now()
            ];
            $id = $this->reflectionsheetManageRepository->insertGetId($data);
            return $id;
        }
    }

    /**
     * Generate number when exist file name
     * */
    private function generateFileName($fileName, $fileType, $pathClass, $index = 1)
    {
        $memberId = auth()->user()->id;
        if (file_exists(public_path('/storage/upload/' . $memberId . '/reflectionsheet/' . $pathClass . '/' . $fileName . '.' . $fileType))) {
            if ($index == 1) {
                $fileName = $fileName . ' (' . $index . ')';
            } else {
                $preIndex = $index - 1;
                $fileName = str_replace('(' . $preIndex . ')', '(' . $index . ')', $fileName);
            }

            return $this->generateFileName($fileName, $fileType, $pathClass, $index + 1);
        }
        return $fileName;
    }

    public function getById($id = 0)
    {
        return $this->reflectionsheetManageRepository->getById($id);
    }

    public function getByUserId($userId = 0)
    {
        return $this->reflectionsheetManageRepository->getByUserId($userId);
    }

    public function updateByMemberId($memberId = 0, $data = [])
    {
        return $this->reflectionsheetManageRepository->updateByMemberId($memberId, $data);
    }

    public function update($id = 0, $data=[])
    {
        return $this->reflectionsheetManageRepository->update($id,$data);
    }

    public function destroy($id = 0)
    {
        return $this->reflectionsheetManageRepository->destroy($id);
    }

}
