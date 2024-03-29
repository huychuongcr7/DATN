<?php

namespace App\Http\Controllers\Customer;

use App\Models\Bill;
use App\Models\Post;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billProducts = DB::table('bill_product')->join('bills', function ($join) {
            $join->on('bills.id', '=', 'bill_product.bill_id');
        })->where('bills.status', '=', Bill::STATUS_COMPLETE)
            ->select(DB::raw('product_id, SUM(quantity) as sum'))
            ->groupBy('product_id')->orderByDesc('sum')->take(4)->pluck('sum', 'product_id')->toArray();

        $productBestSales = Product::where('status', Product::STATUS_ACTIVE)->whereIn('id', array_keys($billProducts))->get()->toArray();
        $productBestSales = array_map(function ($product) use ($billProducts) {
            $product['sum'] = $billProducts[$product['id']];
            return $product;
        }, $productBestSales);
        usort($productBestSales, function ($a, $b) {
            return $a['sum'] < $b['sum'];
        });

        $productNews = Product::where('status', '=', Product::STATUS_ACTIVE)->orderByDesc('created_at')->take(4)->get();

        $posts = Post::where('status', '=', Post::STATUS_ACTIVE)->orderByDesc('view')->take(6)->get();

        return view('customer.home', compact('productBestSales', 'productNews', 'posts'));
    }
}
