<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    const STATUS_ACTIVE = 1;
    const STATUS_STOP = 2;

    const FOLDER = '/images/posts/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_code',
        'title',
        'content',
        'description',
        'status',
        'user_id',
        'img_url',
        'view',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        self::STATUS_ACTIVE => 'Công bố',
        self::STATUS_STOP => 'Ngừng công bố'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
