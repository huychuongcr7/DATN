<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService implements SupplierServiceInterface
{
    public function paymentSupplier(array $params, int $id)
    {
        \DB::beginTransaction();

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'supplier_debt' => $supplier->supplier_debt - $params['total_payment']
        ]);

        foreach ($params['import_orders'] as $value) {
            $importOrder = $supplier->importOrders()->findOrFail($value['id']);
            $importOrder->update([
                'paid_to_supplier' => $importOrder->paid_to_supplier + $value['paid_to_supplier']
            ]);
        }

        \DB::commit();
    }
}
