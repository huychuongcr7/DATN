<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request['product_id']);
        if ($product->inventory > 0) {
            $request['customer_id'] = Auth::user()->id;
            $cart = Cart::where('customer_id', '=', $request['customer_id'])->where('product_id', '=', $request['product_id'])->first();
            if (!($cart)) {
                Cart::create($request->all());
            } else {
                $cart->update([
                    'quantity' => $cart->quantity + $request['quantity']
                ]);
            }
            Alert::success('Thành công', 'Sản phẩm đã được thêm vào giỏ hàng!');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request['quantity'] == 0) {
            Cart::where('product_id', '=', $id)->where('customer_id', '=', Auth::id())->delete();
        }
        Cart::where('product_id', '=', $id)->where('customer_id', '=', Auth::id())->update([
            'quantity' => $request['quantity']
        ]);
        return response([], 204);
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
