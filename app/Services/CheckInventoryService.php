<?php

namespace App\Services;

use App\Models\CheckInventory;
use App\Models\CheckInventoryProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckInventoryService implements CheckInventoryServiceInterface
{
    public function createCheckInventory(array $params)
    {
        \DB::beginTransaction();

        if (!isset($params['check_inventory_code'])) {
            $last = CheckInventory::orderBy('check_inventory_code', 'desc')->withTrashed()->first();
            $checkInventoryCode = isset($last->check_inventory_code) ? $last->check_inventory_code : 'KK000000';
            $checkInventoryCode++;
            $params['check_inventory_code'] = $checkInventoryCode;
        }
        $params['time_check'] = isset($params['time_check'])
            ? Carbon::createFromFormat('Y-m-d H:i', $params['time_check'])->format('Y-m-d H:i:s')
            : now()->format('Y-m-d H:i:s');
        $params['user_id'] = Auth::id();
        $params['status'] = CheckInventory::STATUS_TEMPORARY;

        $checkInventory = CheckInventory::create($params);

        foreach ($params['check_inventory_products'] as $value) {
            $checkInventory->checkInventoryProducts()->create([
                'check_inventory_id' => $checkInventory['id'],
                'product_id' => $value['product_id'],
                'inventory_reality' => $value['inventory_reality'],
                'difference' => $value['difference'],
            ]);
        }

        \DB::commit();
    }

    public function updateCheckInventory(array $params, int $id)
    {
        \DB::beginTransaction();

        $checkInventory = CheckInventory::findOrFail($id);

        $params['time_check'] = isset($params['time_check'])
            ? Carbon::createFromFormat('Y-m-d H:i', $params['time_check'])->format('Y-m-d H:i:s')
            : now()->format('Y-m-d H:i:s');

        $checkInventory->update($params);

        $checkInventoryProductIds = [];
        foreach ($params['check_inventory_products'] as $value) {
            if (isset($value['id'])) {
                $checkInventory->checkInventoryProducts()->findOrFail($value['id'])->update([
                    'inventory_reality' => $value['inventory_reality'],
                    'difference' => $value['difference']
                ]);
                array_push($checkInventoryProductIds, $value['id']);
                continue;
            }

            $checkInventoryProduct = CheckInventoryProduct::create([
                'check_inventory_id' => $checkInventory['id'],
                'product_id' => $value['product_id'],
                'inventory_reality' => $value['inventory_reality'],
                'difference' => $value['difference'],
            ]);
            array_push($checkInventoryProductIds, $checkInventoryProduct->id);
        }
        // Delete
        $checkInventory->checkInventoryProducts()->whereNotIn('id', $checkInventoryProductIds)->delete();

        \DB::commit();
    }

    public function deleteCheckInventory(int $id)
    {
        // TODO: Implement deleteCheckInventory() method.
    }
}
