<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $perPage = 4;

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
        'category_id',
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

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryPost');
    }

    public function getPosts(array $request)
    {
        $builder = $this->where('status', Post::STATUS_ACTIVE);
        if (isset($request['keyword'])) {
            $builder->where('title', 'like', '%' . $request['keyword'] . '%');
        }
        if (isset($request['category_id'])) {
            $builder->where('category_id', $request['category_id']);
        }
        return $builder->paginate();
    }
}
