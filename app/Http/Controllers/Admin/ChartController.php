<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\Product;
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
        $productBestSales = array_map(function ($product) use ($billProducts) {
            $product['sum'] = $billProducts[$product['id']];
            return $product;
        }, $productBestSales);
        usort($productBestSales, function ($a, $b) {
            return $a['sum'] < $b['sum'];
        });
        $productNames = array_map(function ($product) {
            return $product['name'];
        }, $productBestSales);
        $productSums = array_map(function ($product) {
            return $product['sum'];
        }, $productBestSales);

        // Category
        $countCategories = Product::select(DB::raw('count(id) as `data`'), 'category_id')
            ->groupBy('category_id')
            ->get();
        $countCategories = array_map(function ($countCategories) {
            return $countCategories['data'];
        }, $countCategories->toArray());

        // Top 10 inventory
        $inventories = Product::orderByDesc('inventory')->take(10)->get();
        $productNameInventories = array_map(function ($product) {
            return $product['name'];
        }, $inventories->toArray());
        $productInventories = array_map(function ($product) {
            return $product['inventory'];
        }, $inventories->toArray());

        return view('admin.charts.product')
            ->with('productNames', json_encode($productNames))
            ->with('productSums', json_encode($productSums))
            ->with('countCategories', json_encode($countCategories))
            ->with('categories', json_encode(\App\Models\Category::pluck('name')->toArray()))
            ->with('productNameInventories', json_encode($productNameInventories))
            ->with('productInventories', json_encode($productInventories));
    }
}
