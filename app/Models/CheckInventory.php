<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckInventory extends Model
{
    use SoftDeletes;

    protected $table = 'check_inventories';

    const STATUS_TEMPORARY = 1;
    const STATUS_BALANCE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'check_inventory_code',
        'user_id',
        'time_check',
        'time_balance',
        'total_difference',
        'status',
        'note',
    ];

    protected $dates = [
        'time_check',
        'time_balance',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        self::STATUS_TEMPORARY => 'Tạm thời',
        self::STATUS_BALANCE => 'Đã cân bằng'
    ];

    /**
     * Get the check inventory products
     */
    public function checkInventoryProducts()
    {
        return $this->hasMany('App\Models\CheckInventoryProduct');
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
