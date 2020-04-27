<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd($this->request);
        return [
            'bill_products' => 'required',
            'bill_products.*.quantity' => 'required|digits_between:1,5',
            'bill_code' => sprintf('%s|unique:bills,bill_code,%s,id|string|max:10',
                $this->id? 'required' : 'nullable',
                $this->id ?? NULL),
            'customer_id' => 'required|in:' . Customer::pluck('id')->implode(','),
            'paid_by_customer' => 'required|digits_between:1,10',
            'time_of_sale' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable|string|max:65535',
        ];
    }

    /**
     * change attributes name
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'bill_products' => 'sản phẩm',
            'bill_products.*.quantity' => 'số lượng',
            'bill_code' => 'mã hóa đơn',
            'customer_id' => 'khách hàng',
            'paid_by_customer' => 'khách đã trả',
            'time_of_sale' => 'thời gian bán',
            'note' => 'ghi chú',
        ];
    }
}
