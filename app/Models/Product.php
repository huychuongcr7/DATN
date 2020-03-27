<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    const STATUS_ACTIVE = 1;
    const STATUS_STOP = 2;

    const TYPE_SALE = 1;
    const TYPE_NO_SALE = 2;

    const FOLDER = '/images/customers/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_code',
        'qr_code',
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
        'type',
        'description',
        'note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        self::STATUS_ACTIVE => 'Kinh doanh',
        self::STATUS_STOP => 'Ngừng kinh doanh'
    ];

    public static $types = [
        self::TYPE_SALE => 'Bán trực tiếp',
        self::TYPE_NO_SALE => 'Không bán trực tiếp'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function trademark()
    {
        return $this->belongsTo('App\Models\Trademark');
    }
}
