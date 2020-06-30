<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => sprintf('required|unique:users,name,%s,id|string|max:64', $this->id ?? NULL),
            'email' => sprintf('required|unique:users,email,%s,id|unique:customers,email|email|max:64', $this->id ?? NULL),
            'password' => sprintf('%s|string|min:6|max:64', $this->id ? 'nullable' : 'required'),
            'password_confirmation' => 'required_with:password|same:password|max:64',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'role' => 'nullable|in:' . implode(',', array_keys(User::$roles)),
            'gender' => 'nullable|in:' . implode(',', array_keys(User::$genders)),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
}
