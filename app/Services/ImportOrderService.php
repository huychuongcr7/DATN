<?php

namespace App\Services;

use App\Models\ImportOrder;
use App\Models\ImportOrderProduct;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImportOrderService implements ImportOrderServiceInterface
{
    /**
     * create import order
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createImportOrder(array $params)
    {
        \DB::beginTransaction();

        if (!isset($params['import_order_code'])) {
            $last = ImportOrder::orderBy('import_order_code', 'desc')->withTrashed()->first();
            $import_order_code = isset($last->import_order_code) ? $last->import_order_code : 'NH000000';
            $import_order_code++;
            $params['import_order_code'] = $import_order_code;
        }
        $params['time_of_import'] = isset($params['time_of_import'])
            ? Carbon::createFromFormat('Y-m-d H:i', $params['time_of_import'])->format('Y-m-d H:i:s')
            : now()->format('Y-m-d H:i:s');
        $params['user_id'] = Auth::user()->id;

        $importOrder = ImportOrder::create($params);

        foreach ($params['import_order_products'] as $value) {
            $importOrder->importOrderProducts()->create([
                'import_order_id' => $importOrder['id'],
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'unit_price' => $value['unit_price']
            ]);
            $product = Product::findOrFail($value['product_id']);
            $product->update([
                'entry_price' => (($product->entry_price * $product->inventory) + ($value['quantity'] * $value['unit_price'])) / ($product->inventory + $value['quantity']),
                'inventory' => $product->inventory + $value['quantity'],
            ]);
            if ($product->inventory > $product->inventory_level_min) {
                Notification::create([
                    'title' => 'Cảnh báo vượt tồn kho',
                    'content' => 'Tồn kho của sản phẩm ' . $product->name . ' lớn hơn định mức tồn kho lớn nhất!',
                    'status' => Notification::STATUS_UNREAD,
                ]);
            }
        }

        $supplier = Supplier::findOrFail($params['supplier_id']);
        $supplier->update([
            'supplier_debt' => $supplier->supplier_debt + ($importOrder->total_money - $importOrder->paid_to_supplier)
        ]);

        \DB::commit();
    }

    /**
     * update import order
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updateImportOrder(array $params, int $id)
    {
        \DB::beginTransaction();

        $importOrder = ImportOrder::findOrFail($id);

        $params['time_of_import'] = isset($params['time_of_import'])
            ? Carbon::createFromFormat('Y-m-d H:i', $params['time_of_import'])->format('Y-m-d H:i:s')
            : now()->format('Y-m-d H:i:s');

        $supplier = Supplier::findOrFail($params['supplier_id']);
        $supplier->update([
            'supplier_debt' => $supplier->supplier_debt - ($importOrder->total_money - $importOrder->paid_to_supplier) + ($params['total_money'] - $params['paid_to_supplier'])
        ]);

        $importOrder->update($params);

        $importOrderProductIds = [];
        foreach ($params['import_order_products'] as $value) {
            if (isset($value['id'])) {
                $unitPriceOld = ImportOrderProduct::findOrFail($value['id'])->unit_price;
                $quantityOld = ImportOrderProduct::findOrFail($value['id'])->quantity;

                $importOrder->importOrderProducts()->findOrFail($value['id'])->update([
                    'quantity' => $value['quantity'],
                    'unit_price' => $value['unit_price']
                ]);
                $product = Product::findOrFail($value['product_id']);
                $product->update([
                    'entry_price' => (($product->entry_price * $product->inventory) + ($value['quantity'] * $value['unit_price']) - ($quantityOld * $unitPriceOld)) / ($product->inventory + $value['quantity'] - $quantityOld),
                    'inventory' => $product->inventory + $value['quantity'] - $quantityOld,
                ]);
                array_push($importOrderProductIds, $value['id']);
                continue;
            }

            $importOrderProduct = ImportOrderProduct::create([
                'import_order_id' => $importOrder['id'],
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'unit_price' => $value['unit_price']
            ]);
            $product = Product::findOrFail($value['product_id']);
            $product->update([
                'entry_price' => (($product->entry_price * $product->inventory) + ($value['quantity'] * $value['unit_price'])) / ($product->inventory + $value['quantity']),
                'inventory' => $product->inventory + $value['quantity'],
            ]);
            array_push($importOrderProductIds, $importOrderProduct->id);
        }
        // Delete
        $importOrderProductDeleteds = $importOrder->importOrderProducts()->whereNotIn('id', $importOrderProductIds)->get();
        foreach ($importOrderProductDeleteds as $importOrderProductDeleted) {
            if (isset($importOrderDeleted->product_id)) {
                $unitPriceOld = $importOrderProductDeleted->unit_price;
                $quantityOld = $importOrderProductDeleted->quantity;
                $importOrder->importOrderProducts()->whereNotIn('id', $importOrderProductIds)->delete();
                $product = Product::findOrFail($importOrderProductDeleted->product_id);
                $product->update([
                    'entry_price' => (($product->entry_price * $product->inventory) - ($quantityOld * $unitPriceOld)) / ($product->inventory - $quantityOld),
                    'inventory' => $product->inventory - $quantityOld,
                ]);
            }
        }

        \DB::commit();
    }

    /**
     * delete import order
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function deleteImportOrder(int $id)
    {
        \DB::beginTransaction();

        $importOrder = ImportOrder::findOrFail($id);
        $importOrder->delete();

        $supplier = Supplier::findOrFail($importOrder->supplier_id);
        $supplier->update([
            'supplier_debt' => $supplier->supplier_debt - ($importOrder->total_money - $importOrder->paid_to_supplier)
        ]);

        $importOrderProductDeleteds = $importOrder->importOrderProducts()->where('import_order_id', $importOrder->id)->get();
        foreach ($importOrderProductDeleteds as $importOrderProductDeleted) {
            $unitPriceOld = $importOrderProductDeleted->unit_price;
            $quantityOld = $importOrderProductDeleted->quantity;
            $product = Product::findOrFail($importOrderProductDeleted->product_id);
            $product->update([
                'entry_price' => (($product->entry_price * $product->inventory) - ($quantityOld * $unitPriceOld)) / ($product->inventory - $quantityOld),
                'inventory' => $product->inventory - $quantityOld,
            ]);
        }

        \DB::commit();
    }
}
