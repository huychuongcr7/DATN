<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'customer_id',
        'rating',
        'comment'
    ];

    protected $appends = [
        'name',
        'avatar'
    ];

    protected $hidden = ['customer'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->customer->name;
    }

    public function getAvatarAttribute()
    {
        return $this->customer->avatar;
    }
}
