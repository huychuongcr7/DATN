<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $countProduct = Product::where('status', Product::STATUS_ACTIVE)->count();
        $countCategory = Category::count();
        $totalSale = Bill::where('status', Bill::STATUS_COMPLETE)->whereMonth('time_of_sale', date('m'))->sum('total_money');
        $countOrder = Bill::count();

        // Top 10 best sale
        $billProducts = DB::table('bill_product')->join('bills', function ($join) {
            $join->on('bills.id', '=', 'bill_product.bill_id');
        })->where('bills.status', '=', Bill::STATUS_COMPLETE)
            ->whereMonth('bill_product.created_at', date('m'))
            ->select(DB::raw('product_id, SUM(quantity) as sum'))
            ->groupBy('product_id')->orderByDesc('sum')
            ->take(5)->pluck('sum', 'product_id')->toArray();

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

        return view('admin.dashboard', compact('countProduct', 'countCategory', 'countOrder', 'totalSale'))
            ->with('productNames', json_encode($productNames))
            ->with('productSums', json_encode($productSums));
    }
}
