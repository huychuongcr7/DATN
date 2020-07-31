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
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
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

        // test
        $products = json_decode(json_encode(Product::where('status', Product::STATUS_ACTIVE)->get()));

        $productSimilarity = new \App\ProductSimilarity($products);

        $similarityMatrix  = $productSimilarity->calculateSimilarityMatrix();

        $productRecommends          = $productSimilarity->getProductsSortedBySimularity($id, $similarityMatrix);
        array_splice($productRecommends, 4);

        return view('customer.products.show', compact('product', 'productOthers', 'rates', 'productIds', 'productRecommends'));
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
        Product::findOrFail($request['product_id'])->update([
            'rating' => Rate::where('product_id', $request['product_id'])->avg('rating')
        ]);
        return response([], 204);
    }

    public function searchByName(Request $request, $column = 'name')
    {
        $students = Product::where('status', Product::STATUS_ACTIVE)->where('name', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }

    public function searchByProductCode(Request $request)
    {
        $students = Product::where('status', Product::STATUS_ACTIVE)->where('product_code', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }
}
