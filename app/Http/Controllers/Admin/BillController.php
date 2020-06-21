<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBillRequest;
use App\Jobs\SendOrderMail;
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
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', Product::STATUS_ACTIVE)->get();
        $customers = Customer::pluck('name', 'id');
        return view('admin.bills.create', compact('products', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBillRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        $this->billService->createBill($request->all());
        flash('Thêm mới hóa đơn thành công!')->success();
        return redirect()->route('admin.bills.index');
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
        return view('admin.bills.show', compact('bill', 'products'));
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
        return view('admin.bills.edit', compact('products', 'customers', 'bill', 'billProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBillRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBillRequest $request, $id)
    {
        $this->billService->updateBill($request->all(), $id);
        flash('Cập nhật hóa đơn thành công!')->success();
        return redirect()->route('admin.bills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->billService->deleteBill($id);
        flash('Xóa hóa đơn thành công!')->success();
        return redirect()->route('admin.bills.index');
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

    public function complete($id)
    {
        $this->billService->completeBill($id);
        flash('Đơn hàng đã hoàn tất!')->success();
        return redirect()->back();
    }

    public function cancel(Request $request, int $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->update([
            'status' => Bill::STATUS_CANCEL
        ]);
        dispatch(new SendOrderMail($bill, $request['reason']));

        flash('Đơn hàng đã hủy!')->error();
        return redirect()->back();
    }
}
