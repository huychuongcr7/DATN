<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaymentCustomerRequest;
use App\Http\Requests\PaymentSupplierRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Supplier;
use App\Services\CustomerServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderByDesc('updated_at')->get();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customerTypes = Customer::$types;
        $genders = Customer::$genders;
        return view('admin.customers.create', compact('customerTypes', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->createCustomer($request->all());
        flash('Thêm mới khách hàng thành công!')->success();
        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customerTypes = Customer::$types;
        $genders = Customer::$genders;
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer', 'customerTypes', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCustomerRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, int $id)
    {
        $this->customerService->updateCustomer($request->all(), $id);
        flash('Cập nhật khách hàng thành công!')->success();
        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        flash('Xóa khách hàng thành công!')->success();
        return redirect()->route('admin.customers.index');
    }

    /**
     * stop customer
     *
     * @param $id
     * @return RedirectResponse
     */
    public function stop($id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'status' => 2
        ]);
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
        $customer = Customer::find($id);
        $customer->update([
            'status' => 1
        ]);
        return redirect()->back();
    }

    /**
     * get view payment
     *
     * @param $id
     * @return Factory|View
     */
    public function getPayment($id) {
        $customer = Customer::findOrFail($id);
        $bills = $customer->bills()->get();
        return view('admin.customers.payment', compact('customer', 'bills'));
    }

    /**
     * payment supplier
     *
     * @param PaymentCustomerRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function putPayment(PaymentCustomerRequest $request, int $id) {
        $this->customerService->paymentCustomer($request->all(), $id);
        flash('Thanh toán cho khách hàng cấp thành công!')->success();
        return redirect()->route('admin.customers.index');
    }
}
