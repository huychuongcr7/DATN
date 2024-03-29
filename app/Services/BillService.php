<?php

namespace App\Services;

use App\Jobs\SendOrderMail;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BillService implements BillServiceInterface
{
    /**
     * create bill
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createBill(array $params)
    {
        \DB::beginTransaction();

        if (!isset($params['bill_code'])) {
            $last = Bill::orderBy('bill_code', 'desc')->withTrashed()->first();
            $bill_code = isset($last->bill_code) ? $last->bill_code : 'HD000000';
            $bill_code++;
            $params['bill_code'] = $bill_code;
        }
        $params['time_of_sale'] = isset($params['time_of_sale'])
            ? Carbon::createFromFormat('Y-m-d H:i', $params['time_of_sale'])->format('Y-m-d H:i:s')
            : now()->format('Y-m-d H:i:s');
        $params['user_id'] = Auth::user()->id;
        $params['status'] = Bill::STATUS_COMPLETE;
        $params['address_receive'] = 'Tại cửa hàng';

        $bill = Bill::create($params);

        foreach ($params['bill_products'] as $value) {
            $bill->billProducts()->create([
                'bill_id' => $bill['id'],
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'created_at' => now()
            ]);
            $product = Product::findOrFail($value['product_id']);
            $product->update([
                'inventory' => $product->inventory - $value['quantity'],
            ]);

            $url = route('admin.products.show', $product->id);
            if ($product->inventory < $product->inventory_level_min) {
                $notification = Notification::create([
                    'title' => 'Cảnh báo hết hàng',
                    'content' => 'Tồn kho của sản phẩm ' . '<a href="' . $url . '">' . $product->name . '</a>' . ' nhỏ hơn định mức tồn kho bé nhất. Vui lòng nhập thêm hàng!',
                    'status' => Notification::STATUS_UNREAD,
                    'type' => Notification::TYPE_CREATE_ORDER,
                    'user_id' => 1
                ]);

                // pusher
                $data['id'] = $notification->id;
                $data['title'] = $notification->title;
                $data['content'] = $notification->content;
                $data['type'] = $notification->type;
                $data['created_at'] = $notification->created_at->diffForHumans();
                event(new \App\Events\NotificationEvent($data));
            }
        }

        \DB::commit();
    }

    /**
     * update bill
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updateBill(array $params, int $id)
    {
        \DB::beginTransaction();

        $bill = Bill::findOrFail($id);
        $bill->update($params);

        $billProductIds = [];
        foreach ($params['bill_products'] as $value) {
            if (isset($value['id'])) {
                $quantityOld = BillProduct::findOrFail($value['id'])->quantity;

                $bill->billProducts()->findOrFail($value['id'])->update([
                    'quantity' => $value['quantity'],
                ]);
                if ($bill->status == Bill::STATUS_DELIVERED) {
                    $product = Product::findOrFail($value['product_id']);
                    $product->update([
                        'inventory' => $product->inventory - $value['quantity'] + $quantityOld,
                    ]);
                    $bill->billProducts()->findOrFail($value['id'])->update([
                        'end_inventory' => $product->inventory
                    ]);
                }
                array_push($billProductIds, $value['id']);
                continue;
            }

            $billProduct = BillProduct::create([
                'bill_id' => $bill['id'],
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
            ]);
            array_push($billProductIds, $billProduct->id);
        }
        // Delete
        $billProductDeleteds = $bill->billProducts()->whereNotIn('id', $billProductIds)->get();
        foreach ($billProductDeleteds as $billProductDeleted) {
            if (isset($billProductDeleted->product_id)) {
                $quantityOld = $billProductDeleted->quantity;
                $bill->billProducts()->whereNotIn('id', $billProductIds)->delete();
                if ($bill->status == Bill::STATUS_DELIVERED) {
                    $product = Product::findOrFail($billProductDeleted->product_id);
                    $product->update([
                        'inventory' => $product->inventory + $quantityOld,
                    ]);
                }
            }
        }

        \DB::commit();
    }

    /**
     * delete bill
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function deleteBill(int $id)
    {
        \DB::beginTransaction();

        $bill = Bill::findOrFail($id);
        $bill->delete();

        \DB::commit();
    }

    public function createBillCustomer(array $params)
    {
        \DB::beginTransaction();

        $last = Bill::orderBy('bill_code', 'desc')->withTrashed()->first();
        $bill_code = isset($last->bill_code) ? $last->bill_code : 'HD000000';
        $bill_code++;
        $params['bill_code'] = $bill_code;
        $params['customer_id'] = Auth::user()->id;
        $params['paid_by_customer'] = 0;
        $params['status'] = Bill::STATUS_WAIT_CONFIRM;
        $customer = Customer::findOrFail($params['customer_id']);
        $params['address_receive'] = isset($params['select_address'])
            ? ($params['select_address'] == 0 ? $customer->address : $params['address_other'])
            : $params['address'];
        $params['phone_receive'] = $customer->phone;

        $bill = Bill::create($params);
        dispatch(new SendOrderMail($bill));
        $url = route('admin.bills.show', $bill->id);
        $notification = Notification::create([
            'title' => 'Đơn hàng mới',
            'content' => 'Đơn hàng ' . '<a href="' . $url . '">' . $bill->bill_code . '</a>' . ' vừa được tạo. Vui lòng kiểm tra để xử lý!',
            'status' => Notification::STATUS_UNREAD,
            'type' => Notification::TYPE_CREATE_ORDER,
            'user_id' => 1
        ]);

        // pusher
        $data['id'] = $notification->id;
        $data['title'] = $notification->title;
        $data['content'] = $notification->content;
        $data['type'] = $notification->type;
        $data['created_at'] = $notification->created_at->diffForHumans();
        event(new \App\Events\NotificationEvent($data));

        $carts = Cart::where('customer_id', $params['customer_id'])->get();
        foreach ($carts as $cart) {
            $bill->billProducts()->create([
                'bill_id' => $bill['id'],
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
            $cart->delete();
        }

        \DB::commit();
    }

    public function completeBill(int $id)
    {
        \DB::beginTransaction();

        $bill = Bill::findOrFail($id);
        $bill->update([
            'status' => Bill::STATUS_COMPLETE,
            'time_of_sale' => now()->format('Y-m-d H:i:s')
        ]);
        dispatch(new SendOrderMail($bill));

        \DB::commit();
    }

    public function exportProduct(int $id)
    {
        \DB::beginTransaction();

        $bill = Bill::findOrFail($id);
        $bill->update([
            'status' => Bill::STATUS_EXPORT
        ]);

        $billProducts = $bill->billProducts()->get();
        foreach ($billProducts as $billProduct) {
            $product = Product::findOrFail($billProduct->product_id);
            $product->update([
                'inventory' => $product->inventory - $billProduct->quantity,
            ]);
            $billProduct->update([
                'end_inventory' => $product->inventory
            ]);
            $url = route('admin.products.show', $product->id);
            if ($product->inventory < $product->inventory_level_min) {
                $notification = Notification::create([
                    'title' => 'Cảnh báo hết hàng',
                    'content' => 'Tồn kho của sản phẩm ' . '<a href="' . $url . '">' . $product->name . '</a>' . ' nhỏ hơn định mức tồn kho bé nhất. Vui lòng nhập thêm hàng!',
                    'status' => Notification::STATUS_UNREAD,
                    'type' => Notification::TYPE_SMALLER_INVENTORY,
                    'user_id' => 1
                ]);

                // pusher
                $data['id'] = $notification->id;
                $data['title'] = $notification->title;
                $data['content'] = $notification->content;
                $data['type'] = $notification->type;
                $data['created_at'] = $notification->created_at->diffForHumans();
                event(new \App\Events\NotificationEvent($data));
            }
        }

        \DB::commit();
    }

    public function updateBillStocker(array $params, int $id)
    {
        \DB::beginTransaction();

        $bill = Bill::findOrFail($id);
        $bill->update($params);

        $billProductIds = [];
        foreach ($params['bill_products'] as $value) {
            if (isset($value['id'])) {
                $quantityOld = BillProduct::findOrFail($value['id'])->quantity;
                $product = Product::findOrFail($value['product_id']);
                $product->update([
                    'inventory' => $product->inventory - $value['quantity'] + $quantityOld,
                ]);
                $bill->billProducts()->findOrFail($value['id'])->update([
                    'quantity' => $value['quantity'],
                    'end_inventory' => $product->inventory
                ]);
                array_push($billProductIds, $value['id']);
            }
        }
        // Delete
        $billProductDeleteds = $bill->billProducts()->whereNotIn('id', $billProductIds)->get();
        foreach ($billProductDeleteds as $billProductDeleted) {
            if (isset($billProductDeleted->product_id)) {
                $quantityOld = $billProductDeleted->quantity;
                $bill->billProducts()->whereNotIn('id', $billProductIds)->delete();
                $product = Product::findOrFail($billProductDeleted->product_id);
                $product->update([
                    'inventory' => $product->inventory + $quantityOld,
                ]);
            }
        }

        \DB::commit();
    }
}
