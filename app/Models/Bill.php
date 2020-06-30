<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $table = 'bills';

    const STATUS_WAIT_CONFIRM = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_ASSIGNED = 3;
    const STATUS_EXPORT = 4;
    const STATUS_DELIVERY = 5;
    const STATUS_DELIVERED = 6;
    const STATUS_COMPLETE = 7;
    const STATUS_CANCEL = 8;

    const METHOD_TRANSFER = 1;
    const METHOD_CASH = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_code',
        'customer_id',
        'user_id',
        'total_money',
        'paid_by_customer',
        'time_of_sale',
        'status',
        'address_receive',
        'phone_receive',
        'payment_method',
        'note',
    ];

    protected $dates = [
        'time_of_sale',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
        'name_customer'
    ];

    public static $statuses = [
        self::STATUS_WAIT_CONFIRM => 'Chờ xác nhận',
        self::STATUS_CONFIRM => 'Xác nhận',
        self::STATUS_ASSIGNED => 'Đã phân công',
        self::STATUS_EXPORT => 'Đã xuất hàng',
        self::STATUS_DELIVERY => 'Đang giao hàng',
        self::STATUS_DELIVERED => 'Đã giao hàng',
        self::STATUS_COMPLETE => 'Hoàn tất',
        self::STATUS_CANCEL => 'Hủy bỏ'
    ];

    public static $payMethods = [
        self::METHOD_TRANSFER => 'Chuyển khoản',
        self::METHOD_CASH => 'Tiền mặt'
    ];

    /**
     * Get the products
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'bill_product', 'bill_id', 'product_id')
            ->withPivot('quantity');
    }

    /**
     * Get the bill products
     */
    public function billProducts()
    {
        return $this->hasMany('App\Models\BillProduct');
    }

    /**
     * Get the customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getNameCustomerAttribute()
    {
        return $this->customer->name ?? null;
    }
}
