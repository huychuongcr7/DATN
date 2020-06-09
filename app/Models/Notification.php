<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $table = 'notifications';

    const STATUS_READ = 1;
    const STATUS_UNREAD = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'status',
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
