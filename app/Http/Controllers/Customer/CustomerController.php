<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\BillServiceInterface;
use App\Services\CustomerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    protected $billService;
    protected $customerService;
    public function __construct(CustomerServiceInterface $customerService, BillServiceInterface $billService)
    {
        $this->customerService = $customerService;
        $this->billService = $billService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where('id', Auth::id())->first();
        return view('customer.customers.info', compact('customer'));
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
        flash('Cập nhật tài khoản thành công!')->success();
        return redirect()->route('customers.index');
    }

    public function getReset(int $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.customers.reset_password', compact('customer'));
    }

    public function putReset(ResetPasswordRequest $request, int $id)
    {
        $customer = Customer::findOrFail($id);

        if (!Hash::check($request['password'], $customer->password)) {
            flash('Mật khẩu không đúng!')->error();
            return redirect()->route('customers.get_reset', $id);
        }
        $customer->update([
            'password' => Hash::make($request['password_new'])
        ]);
        flash('Thay đổi mật khẩu thành công!')->success();
        return redirect()->route('customers.index');
    }

    public function getBill()
    {
        $bills = Bill::where('customer_id', Auth::id())->orderByDesc('time_of_sale')->paginate(3);
        $allProducts = [];
        foreach ($bills as $bill) {
            $billProducts = BillProduct::where('bill_id', $bill->id)->pluck('quantity', 'product_id')->toArray();
            $products = Product::whereIn('id', array_keys($billProducts))->get()->toArray();
            $products = array_map(function ($product) use ($billProducts){
                $product['quantity'] = $billProducts[$product['id']];
                return $product;
            }, $products);
            array_push($allProducts, $products);
        }
        return view('customer.customers.bill', compact('bills', 'allProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBill(Request $request)
    {
        $this->billService->createBillCustomer($request->all());
        return redirect()->route('welcome');
    }
}
