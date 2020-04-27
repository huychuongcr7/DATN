<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $table = 'bills';

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
        'note',
    ];

    protected $dates = [
        'time_of_sale',
        'created_at',
        'updated_at',
        'deleted_at'
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
}
