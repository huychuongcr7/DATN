<?php
namespace App\Services;

use App\Models\User;
use App\Traits\UploadTrait;

class UserService implements UserServiceInterface
{
    use UploadTrait;

    /**
     * create User
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createUser(array $params)
    {
        \DB::beginTransaction();

        $params['password'] = bcrypt($params['password']);
        $params['status'] = User::STATUS_ACTIVE;

        if (isset($params['avatar'])) {
            $image = $params['avatar'];
            $name = uniqid();
            $folder = User::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['avatar'] = $filePath;
        }
        User::create($params);

        \DB::commit();
    }

    /**
     * update User
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updateUser(array $params, int $id)
    {
        \DB::beginTransaction();
        $customer = User::findOrFail($id);

        if (isset($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        } else {
            unset($params['password']);
        }
        if (isset($params['avatar'])) {
            $image = $params['avatar'];
            $name = uniqid();
            $folder = User::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['avatar'] = $filePath;
        }
        $customer->update($params);

        \DB::commit();
    }
}
