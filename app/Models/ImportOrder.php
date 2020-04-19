<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportOrder extends Model
{
    use SoftDeletes;

    protected $table = 'import_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'import_order_code',
        'supplier_id',
        'user_id',
        'total_money',
        'paid_to_supplier',
        'time_of_import',
        'note',
    ];

    protected $dates = [
        'time_of_import',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the products
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'import_order_product', 'import_order_id', 'product_id')
            ->withPivot('quantity', 'unit_price');
    }

    /**
     * Get the import order products
     */
    public function importOrderProducts()
    {
        return $this->hasMany('App\Models\ImportOrderProduct');
    }

    /**
     * Get the supplier
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    /**
     * Get the supplier
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
