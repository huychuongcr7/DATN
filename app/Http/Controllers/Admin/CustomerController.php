<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
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
        $this->customer->createCustomer($request);
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
        //
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
    public function update(StoreCustomerRequest $request)
    {
        $this->customer->updateCustomer($request);
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
}
