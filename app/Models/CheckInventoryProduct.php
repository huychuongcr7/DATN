<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInventoryProduct extends Model
{
    protected $table = 'check_inventory_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'check_inventory_id',
        'product_id',
        'inventory_reality',
        'difference'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
