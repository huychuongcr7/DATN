<?php

namespace App\Http\Controllers\Stocker;

use App\Http\Requests\StoreBillRequest;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Customer;
use App\Models\Product;
use App\Services\BillServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    protected $billService;

    public function __construct(BillServiceInterface $billService)
    {
        $this->billService = $billService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();
        return view('stocker.bills.index', compact('bills'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
        return view('stocker.bills.show', compact('bill', 'products'));
    }

    public function export($id)
    {
        $this->billService->exportProduct($id);
        flash('Đã xuất sản phẩm cho shipper!')->success();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::where('status', Product::STATUS_ACTIVE)->get();
        $customers = Customer::pluck('name', 'id');
        $bill = Bill::findOrFail($id);
        $billProducts = $bill->billProducts()->select('product_id', 'quantity', 'id')->get();
        return view('stocker.bills.edit', compact('products', 'customers', 'bill', 'billProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBillRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->billService->updateBillStocker($request->all(), $id);
        flash('Cập nhật hóa đơn thành công!')->success();
        return redirect()->route('stocker.bills.index');
    }
}
