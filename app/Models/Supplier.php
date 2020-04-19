<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'suppliers';

    const STATUS_ACTIVE = 1;
    const STATUS_STOP = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_code',
        'name',
        'email',
        'address',
        'phone',
        'supplier_debt',
        'status',
        'company',
        'tax_code',
        'note',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $statuses = [
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_STOP => 'Ngừng hoạt động'
    ];

    public function createSupplier(array $params)
    {
        if (!isset($params['supplier_code'])) {
            $last = Supplier::orderBy('supplier_code', 'desc')->first();
            $supplier_code = $last->supplier_code;
            $supplier_code++;
            $params['supplier_code'] = $supplier_code;
        }
        $params['status'] = 1;
        Supplier::create($params);
    }

    public function updateSupplier(array $params, int $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($params);
    }

    /**
     * Get the import order
     */
    public function importOrders() {
        return $this->hasMany('App\Models\ImportOrder');
    }
}
