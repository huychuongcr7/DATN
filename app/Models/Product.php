<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $perPage = 6;

    const STATUS_ACTIVE = 1;
    const STATUS_STOP = 2;

    const FOLDER = '/images/products/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_code',
        'name',
        'image_url',
        'category_id',
        'trademark_id',
        'sale_price',
        'entry_price',
        'inventory',
        'location',
        'inventory_level_min',
        'inventory_level_max',
        'status',
        'description',
        'note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $appends = ['rating'];
    public $hidden = ['rates'];

    public static $statuses = [
        self::STATUS_ACTIVE => 'Kinh doanh',
        self::STATUS_STOP => 'Ngừng kinh doanh'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function trademark()
    {
        return $this->belongsTo('App\Models\Trademark');
    }

    public function rates()
    {
        return $this->hasMany('\App\Models\Rate');
    }

    public function getRatingAttribute()
    {
        return $this->rates->avg('rating') ?? null;
    }

    public function getProducts(array $request)
    {
        $builder = $this->where('status', self::STATUS_ACTIVE);
        if (isset($request['order_by_price'])) {
            if ($request['order_by_price'] == 'asc') {
                $builder->orderBy('sale_price');
            } elseif ($request['order_by_price'] == 'desc') {
                $builder->orderByDesc('sale_price');
            }
        }
        if (isset($request['category_id'])) {
            $builder->where('category_id', $request['category_id']);
        }
        return $builder->paginate();
    }
}
