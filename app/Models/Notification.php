<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $table = 'notifications';
    protected $perPage = 10;

    const STATUS_READ = 1;
    const STATUS_UNREAD = 2;

    const TYPE_CREATE_ORDER = 3;
    const TYPE_CANCEL_ORDER = 4;
    const TYPE_SMALLER_INVENTORY = 5;
    const TYPE_BIGGER_INVENTORY = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'type',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        self::STATUS_READ => 'Đã đọc',
        self::STATUS_UNREAD => 'Chưa đọc'
    ];
}
