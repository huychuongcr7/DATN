<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_code' => sprintf('%s|unique:products,product_code,%s,id|string|max:10',
                $this->id? 'required' : 'nullable',
                $this->id ?? NULL),
            'qr_code' => 'nullable|string|max:64',
            'name' => sprintf('required|unique:products,name,%s,id|string|max:64', $this->id ?? NULL),
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'category_id' => 'required|in:' . Category::pluck('id')->implode(','),
            'trademark_id' => 'nullable|in:' . Trademark::pluck('id')->implode(','),
            'sale_price' => 'required|digits_between:4,10',
            'entry_price' => 'required|digits_between:4,10',
            'inventory' => 'required|integer|max:999',
            'location' => 'nullable|string|max:64',
            'inventory_level_max' => 'required|integer|between:0,999',
            'inventory_level_min' => 'required|integer|between:0,999|lte:inventory_level_max',
            'type' => 'required|in:' . implode(',', array_keys(Product::$types)),
            'description' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:65535'
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
            'product_code' => 'mã sản phẩm',
            'name' => 'tên sản phẩm',
            'category_id' => 'danh mục sản phẩm',
            'trademark_id' => 'thương hiệu',
            'sale_price' => 'giá bán',
            'entry_price' => 'giá gốc',
            'inventory' => 'tồn kho',
            'location' => 'địa điểm',
            'inventory_level_min' => 'định mức tồn kho bé nhất',
            'inventory_level_max' => 'định mức tồn kho lớn nhất',
            'type' => 'loại sản phẩm',
            'description' => 'mô tả',
            'note' => 'ghi chú'
        ];
    }
}
