<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => sprintf('required|unique:customers,name%s|string|max:64',
                $this->id ? ','.$this->id.',id' : NULL),
            'email' => sprintf('required|unique:customers,email%s|unique:users,email|email|max:64',
                $this->id ? ','.$this->id.',id' : NULL),
            'password' => sprintf('%s|string|min:6|max:64', $this->id ? 'nullable' : 'required'),
            'password_confirmation' => 'required_with:password|same:password|max:64',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
            'phone' => 'nullable|string|max:15',
            'customer_type' => 'nullable|in:' . implode(',', array_keys(Customer::$types)),
            'gender' => 'nullable|in:' . implode(',', array_keys(Customer::$genders)),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'facebook_url' => 'nullable|url|max:2048',
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
            'customer_type' => 'loại khách hàng',
        ];
    }
}
