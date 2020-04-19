<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentSupplierRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    protected $supplier;
    protected $supplierService;
    public function __construct(Supplier $supplier, SupplierServiceInterface $supplierService)
    {
        $this->supplier = $supplier;
        $this->supplierService = $supplierService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSupplierRequest $request
     * @return void
     */
    public function store(StoreSupplierRequest $request)
    {
        $this->supplier->createSupplier($request->all());
        flash('Thêm mới nhà cung cấp thành công!')->success();
        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSupplierRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSupplierRequest $request, int $id)
    {
        $this->supplier->updateSupplier($request->all(), $id);
        flash('Cập nhật nhà cung cấp thành công!')->success();
        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        flash('Xóa nhà cung cấp thành công!')->success();
        return redirect()->route('admin.suppliers.index');
    }

    /**
     * stop supplier
     *
     * @param $id
     * @return RedirectResponse
     */
    public function stop($id)
    {
        $supplier = Supplier::find($id);
        $supplier->status = 2;
        $supplier->save();
        return redirect()->back();
    }

    /**
     * active supplier
     *
     * @param $id
     * @return RedirectResponse
     */
    public function active($id)
    {
        $supplier = Supplier::find($id);
        $supplier->status = 1;
        $supplier->save();
        return redirect()->back();
    }

    public function getPayment($id) {
        $supplier = Supplier::findOrFail($id);
        $importOrders = $supplier->importOrders()->get();
        return view('admin.suppliers.payment', compact('supplier', 'importOrders'));
    }

    public function putPayment(PaymentSupplierRequest $request, int $id) {
        $this->supplierService->paymentSupplier($request->all(), $id);
        flash('Thanh toán cho nhà cung cấp thành công!')->success();
        return redirect()->route('admin.suppliers.index');
    }
}
