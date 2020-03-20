<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;
    const STATUS_STOP = 3;

    const MALE = 1;
    const FEMALE = 2;

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
        'avatar'
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

    public static $statuses = [
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_DEACTIVE => 'Vô hiệu hóa',
        self::STATUS_STOP => 'Dừng lại'
    ];

    public static $genders = [
        self::MALE => 'Name',
        self::FEMALE => 'Nữ'
    ];
}
