<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\StoreRateRquest;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->product->getProducts($request->all());
        $categories = Category::pluck('name', 'id');
        return view('customer.products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('status', '=', Product::STATUS_ACTIVE)->findOrFail($id);
        $productOthers = Product::where('status', '=', Product::STATUS_ACTIVE)->where('category_id', '=', $product->category_id)
            ->where('id', '!=', $product->id)->take(4)->get();
        $productIds = [];
        if (Auth::guard('customer')->check()) {
            $customer = Customer::find(Auth::guard('customer')->id());
            $bills = $customer->bills()->where('status', Bill::STATUS_COMPLETE)->get();
            foreach ($bills as $bill) {
                $billProducts = $bill->billProducts()->get();
                foreach ($billProducts as $billProduct) {
                    array_push($productIds, $billProduct->product_id);
                }
            }
        }
        $rates = Rate::where('product_id', $product->id)->get();
        $avg = $rates->avg('rating');
        return view('customer.products.show', compact('product', 'productOthers', 'rates', 'avg', 'productIds'));
    }

    public function storeRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            return response([], 400);
        }
        $request['customer_id'] = Auth::id();
        $rate = Rate::where('customer_id', '=', $request['customer_id'])->where('product_id', $request['product_id'])->first();
        if (!($rate)) {
            Rate::create($request->all());
        } else {
            $rate->update([
                'rating' => $request['rating'],
                'comment' => $request['comment']
            ]);
        }
        return response([], 204);
    }

    public function searchByName(Request $request)
    {
        $students = Product::where('name', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }

    public function searchByProductCode(Request $request)
    {
        $students = Product::where('product_code', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }
}
