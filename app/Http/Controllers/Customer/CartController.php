<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('customer_id', '=', Auth::user()->id)->pluck('quantity', 'product_id')->toArray();
        $products = Product::whereIn('id', array_keys($carts))->get()->toArray();
        $products = array_map(function ($product) use ($carts){
            $product['quantity'] = $carts[$product['id']];
            return $product;
        }, $products);
        return view('customer.customers.cart', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['customer_id'] = Auth::user()->id;
        $cart = Cart::where('customer_id', '=', $request['customer_id'])->where('product_id', '=', $request['product_id'])->first();
        if (!($cart)) {
            Cart::create($request->all());
        } else {
            $cart->update([
                'quantity' => $cart->quantity + $request['quantity']
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('product_id', '=', $id)->where('customer_id', '=', Auth::id())->delete();
        return response([], 204);
    }
}
