<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'created_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * relation to product
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
