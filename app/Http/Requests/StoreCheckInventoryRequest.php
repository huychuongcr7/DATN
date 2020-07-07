<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckInventoryRequest extends FormRequest
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
            'check_inventory_products' => 'required',
            'check_inventory_products.*.inventory_reality' => 'required|digits_between:1,5',
            'check_inventory_code' => sprintf('%s|unique:check_inventories,check_inventory_code%s|string|max:10',
                $this->id? 'required' : 'nullable',
                $this->id ? ','.$this->id.',id' : NULL),
            'time_check' => 'required|date_format:Y-m-d H:i',
            'note' => 'nullable|string|max:65535',
        ];
    }

    /**
     * change attributes name
     *Nc
     * @return array
     */
    public function attributes()
    {
        return [
            'check_inventory_products' => 'sản phẩm',
            'check_inventory_products.*.inventory_reality' => 'tồn kho thực tế',
            'check_inventory_code' => 'mã kiểm kho',
            'time_check' => 'thời gian kiểm kho',
            'note' => 'ghi chú',
        ];
    }
}
