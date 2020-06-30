<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportOrderProduct extends Model
{
    public $timestamps = false;
    protected $table = 'import_order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'import_order_id',
        'product_id',
        'quantity',
        'unit_price',
        'end_inventory'
    ];

    public function importOrder()
    {
        return $this->belongsTo('\App\Models\ImportOrder');
    }
}
