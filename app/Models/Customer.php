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
}
