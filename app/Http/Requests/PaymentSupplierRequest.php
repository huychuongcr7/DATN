<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentSupplierRequest extends FormRequest
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
            'total_payment' => 'required',
            'import_orders.*.paid_to_supplier' => 'required|lte:total_payment'
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
            'total_payment' => 'trả cho NCC',
            'import_orders.*.paid_to_supplier' => 'tiền trả'
        ];
    }
}
