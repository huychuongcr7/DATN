<?php
namespace App\Services;

use App\Models\Customer;
use App\Services\CustomerServiceInterface;
use App\Traits\UploadTrait;

class CustomerService implements CustomerServiceInterface
{
    use UploadTrait;

    /**
     * create Customer
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createCustomer(array $params)
    {
        \DB::beginTransaction();

        $params['password'] = bcrypt($params['password']);

        if (isset($params['avatar'])) {
            $image = $params['avatar'];
            $name = uniqid();
            $folder = Customer::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['avatar'] = $filePath;
        }
        Customer::create($params);

        \DB::commit();
    }

    /**
     * update Customer
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updateCustomer(array $params, int $id)
    {
        \DB::beginTransaction();
        $customer = Customer::findOrFail($id);

        if (isset($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        } else {
            unset($params['password']);
        }
        if (isset($params['avatar'])) {
            $image = $params['avatar'];
            $name = uniqid();
            $folder = Customer::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['avatar'] = $filePath;
        }
        $customer->update($params);

        \DB::commit();
    }
}
