<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'supplier_code' => sprintf('%s|unique:suppliers,supplier_code%s|string|max:10',
                $this->id? 'required' : 'nullable',
                $this->id ? ','.$this->id.',id' : NULL),
            'name' => sprintf('required|unique:suppliers,name,%s,id|string|max:64', $this->id ?? NULL),
            'email' => sprintf('nullable|unique:customers,email,%s,id|email|max:64', $this->id ?? NULL),
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'company' => 'nullable|string|max:255',
            'tax_code' => 'nullable|digits_between:0,10',
            'note' => 'nullable|max:65535'
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
            'supplier_code' => 'mã nhà cung cấp',
            'name' => 'tên nhà cung cấp',
            'tax_code' => 'mã số thuế',
            'note' => 'ghi chú'
        ];
    }
}
