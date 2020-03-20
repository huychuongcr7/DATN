<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use UploadTrait;

    protected $table = 'customers';

    const TYPE_PREMIUM = 1;
    const TYPE_NORMAL = 2;

    const MALE = 1;
    const FEMALE = 2;

    const FOLDER = '/images/customers/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'date_of_birth',
        'phone',
        'customer_type',
        'gender',
        'avatar',
        'facebook_url',
        'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $types = [
        self::TYPE_PREMIUM => 'Cao cấp',
        self::TYPE_NORMAL => 'Bình thường'
    ];

    public static $genders = [
        self::MALE => 'Nam',
        self::FEMALE => 'Nữ'
    ];

    public function createCustomer($request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        if (isset($input['avatar'])) {
            $image = $input['avatar'];
            $name = uniqid();
            $folder = self::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $input['avatar'] = $filePath;
        }
        return $this->create($input);

    }

    public function updateCustomer($request)
    {
        $input = $request->all();
        if (isset($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }
        if (isset($input['avatar'])) {
            $image = $input['avatar'];
            $name = uniqid();
            $folder = self::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $input['avatar'] = $filePath;
        }
        return $this->find($request->id)->update($input);
    }
}
