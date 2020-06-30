<?php

namespace App\Http\Controllers\Shipper;

use App\Jobs\SendOrderMail;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::where('user_id', Auth::id())->get();
        return view('shipper.bills.index', compact('bills'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);
        $billProducts = BillProduct::where('bill_id', $bill->id)->pluck('quantity', 'product_id')->toArray();
        $products = Product::whereIn('id', array_keys($billProducts))->get()->toArray();
        $products = array_map(function ($product) use ($billProducts) {
            $product['quantity'] = $billProducts[$product['id']];
            return $product;
        }, $products);
        return view('shipper.bills.show', compact('bill', 'products'));
    }

    public function delivery($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->update([
            'status' => Bill::STATUS_DELIVERY
        ]);
        dispatch(new SendOrderMail($bill));

        flash('Đơn hàng đã được vận chuyển!')->success();
        return redirect()->back();
    }

    public function delivered($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->update([
            'status' => Bill::STATUS_DELIVERED
        ]);

        flash('Đơn hàng đã hoàn thành vận chuyển!')->success();
        return redirect()->back();
    }
}
