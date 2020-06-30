<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function chartProduct()
    {
        $billProducts = DB::table('bill_product')->join('bills', function ($join) {
            $join->on('bills.id', '=', 'bill_product.bill_id');
        })->where('bills.status', '=', Bill::STATUS_COMPLETE)
            ->whereMonth('bill_product.created_at', date('m'))
            ->select(DB::raw('product_id, SUM(quantity) as sum'))
            ->groupBy('product_id')->orderByDesc('sum')
            ->take(10)->pluck('sum', 'product_id')->toArray();

        $productBestSales = Product::whereIn('id', array_keys($billProducts))->get()->toArray();

        // top 10 revenue in month
        $productBestRevenues = array_map(function ($product) use ($billProducts) {
            $product['revenue'] = $billProducts[$product['id']]*$product['sale_price'];
            return $product;
        }, $productBestSales);

        // top 10 quantity in month
        $productBestQuantities = array_map(function ($product) use ($billProducts) {
            $product['sum'] = $billProducts[$product['id']];
            return $product;
        }, $productBestSales);

        usort($productBestRevenues, function ($a, $b) {
            return $a['revenue'] < $b['revenue'];
        });
        usort($productBestQuantities, function ($a, $b) {
            return $a['sum'] < $b['sum'];
        });

        $productNameRevenues = array_map(function ($product) {
            return $product['name'];
        }, $productBestRevenues);
        $productSumRevenues = array_map(function ($product) {
            return $product['revenue'];
        }, $productBestRevenues);

        $productNameQuantities = array_map(function ($product) {
            return $product['name'];
        }, $productBestQuantities);
        $productSumQuantities = array_map(function ($product) {
            return $product['sum'];
        }, $productBestQuantities);

        // Top 10 inventory
        $inventories = Product::orderByDesc('inventory')->take(10)->get();
        $productNameInventories = array_map(function ($product) {
            return $product['name'];
        }, $inventories->toArray());
        $productInventories = array_map(function ($product) {
            return $product['inventory'];
        }, $inventories->toArray());


        return view('admin.charts.product')
            ->with('productNameQuantities', json_encode($productNameQuantities))
            ->with('productSumQuantities', json_encode($productSumQuantities))
            ->with('productNameRevenues', json_encode($productNameRevenues))
            ->with('productSumRevenues', json_encode($productSumRevenues))
            ->with('productNameInventories', json_encode($productNameInventories))
            ->with('productInventories', json_encode($productInventories));
    }

    public function chartCustomer()
    {
        $bills = DB::table('bills')->where('bills.status', Bill::STATUS_COMPLETE)
            ->whereMonth('bills.time_of_sale', date('m'))
            ->select(DB::raw('customer_id, SUM(total_money) as sum'))
            ->groupBy('customer_id')->orderByDesc('sum')
            ->take(10)->get()->toArray();
        $names = array_map(function ($bill) {
            return Customer::findOrFail($bill->customer_id)->name;
        }, $bills);
        $sums = array_map(function ($bill) {
            return $bill->sum;
        }, $bills);
        return view('admin.charts.customer')
            ->with('names', json_encode($names))
            ->with('sums', json_encode($sums));
    }

    public function chartSupplier()
    {
        $importOrders = DB::table('import_orders')
            ->whereMonth('import_orders.time_of_import', date('m'))
            ->select(DB::raw('supplier_id, SUM(total_money) as sum'))
            ->groupBy('supplier_id')->orderByDesc('sum')
            ->take(10)->get()->toArray();
        $names = array_map(function ($importOrder) {
            return Supplier::findOrFail($importOrder->supplier_id)->name;
        }, $importOrders);
        $sums = array_map(function ($importOrder) {
            return $importOrder->sum;
        }, $importOrders);
        return view('admin.charts.supplier')
            ->with('names', json_encode($names))
            ->with('sums', json_encode($sums));
    }
}
