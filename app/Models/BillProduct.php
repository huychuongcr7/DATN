<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    public $timestamps = false;
    protected $table = 'bill_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id',
        'product_id',
        'quantity',
    ];
}
