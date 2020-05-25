<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillCustomerRequest extends FormRequest
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
            'address_other' => sprintf('%s|string|max:255', $this->select_address == 1 ? 'required' : 'nullable'),
            'address' => sprintf('%s|string|max:255', isset($this->select_address) ? 'nullable' : 'required'),
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
            'address_other' => 'địa chỉ',
        ];
    }
}
