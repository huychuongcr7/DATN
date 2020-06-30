<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    const STATUS_ACTIVE = 1;
    const STATUS_STOP = 2;

    const MALE = 1;
    const FEMALE = 2;

    const ROLE_ADMIN = 1;
    const ROLE_SHIPPER = 2;
    const ROLE_STOCKER = 3;

    const FOLDER = '/images/users/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'gender',
        'role',
        'avatar',
        'address',
        'phone'
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

    protected $appends = ['count_bill'];

    public static $statuses = [
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_STOP => 'Ngừng hoạt động',
    ];

    public static $genders = [
        self::MALE => 'Nam',
        self::FEMALE => 'Nữ'
    ];

    public static $roles = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_SHIPPER => 'Shipper',
        self::ROLE_STOCKER => 'Quản lý kho'
    ];

    public function bills()
    {
        return $this->hasMany('\App\Models\Bill')->where('status', Bill::STATUS_COMPLETE);
    }

    public function getCountBillAttribute()
    {
        return $this->bills->count() ?? null;
    }
}
