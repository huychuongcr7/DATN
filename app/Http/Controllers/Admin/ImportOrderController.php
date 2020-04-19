<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreImportOrderRequest;
use App\Models\ImportOrder;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\ImportOrderServiceInterface;
use App\Http\Controllers\Controller;

class ImportOrderController extends Controller
{
    protected $importOrderService;
    public function __construct(ImportOrderServiceInterface $importOrderService)
    {
        $this->importOrderService = $importOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importOrders = ImportOrder::all();
        return view('admin.import_orders.index', compact('importOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::pluck('name', 'id');
        return view('admin.import_orders.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreImportOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImportOrderRequest $request)
    {
        $this->importOrderService->createImportOrder($request->all());
        flash('Thêm mới đơn nhập hàng thành công!')->success();
        return redirect()->route('admin.import_orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $importOrder = ImportOrder::findOrFail($id);
        return view('admin.import_orders.show', compact('importOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $suppliers = Supplier::pluck('name', 'id');
        $importOrder = ImportOrder::findOrFail($id);
        $importOrderProducts = $importOrder->importOrderProducts()->select('product_id', 'quantity', 'unit_price','id')->get();
        return view('admin.import_orders.edit', compact('products', 'suppliers', 'importOrder', 'importOrderProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreImportOrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreImportOrderRequest $request, $id)
    {
        $this->importOrderService->updateImportOrder($request->all(), $id);
        flash('Cập nhật đơn nhập hàng thành công!')->success();
        return redirect()->route('admin.import_orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->importOrderService->deleteImportOrder($id);
        flash('Xóa đơn nhập hàng thành công!')->success();
        return redirect()->route('admin.import_orders.index');
    }
}
