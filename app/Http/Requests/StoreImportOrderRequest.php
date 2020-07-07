<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class StoreImportOrderRequest extends FormRequest
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
        return [
            'import_order_products' => 'required',
            'import_order_products.*.quantity' => 'required|digits_between:1,5',
            'import_order_products.*.unit_price' => 'required|digits_between:1,10',
            'import_order_code' => sprintf('%s|unique:import_orders,import_order_code%s|string|max:10',
                $this->id? 'required' : 'nullable',
                $this->id ? ','.$this->id.',id' : NULL),
            'supplier_id' => 'required|in:' . Supplier::pluck('id')->implode(','),
            'paid_to_supplier' => 'required|digits_between:1,10',
            'time_of_import' => 'required|date_format:Y-m-d H:i',
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
            'import_order_products' => 'sản phẩm',
            'import_order_products.*.quantity' => 'số lượng',
            'import_order_products.*.unit_price' => 'đơn giá',
            'import_order_code' => 'mã đơn nhập',
            'supplier_id' => 'nhà cung cấp',
            'paid_to_supplier' => 'đã trả NCC',
            'time_of_import' => 'thời gian nhâp',
            'note' => 'ghi chú',
        ];
    }
}
