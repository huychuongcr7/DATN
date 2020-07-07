<?php

namespace App\Http\Requests;

use App\Models\CategoryPost;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'post_code' => sprintf('%s|unique:posts,post_code%s|string|max:10',
                $this->id ? 'required' : 'nullable',
                $this->id ? ','.$this->id.',id' : NULL),
            'title' => 'required|string|max:64',
            'content' => 'required|string|max:65535',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|in:' . CategoryPost::pluck('id')->implode(','),
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
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
            'category_id' => 'danh mục bài đăng',
        ];
    }
}
