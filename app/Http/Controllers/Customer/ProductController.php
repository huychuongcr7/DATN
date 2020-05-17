<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        return view('customer.products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $productOthers = Product::where('type', '=', Product::TYPE_SALE)->where('category_id', '=', $product->category_id)
            ->where('id', '!=', $product->id)->take(4)->get();
        return view('customer.products.show', compact('product', 'productOthers'));
    }
}
