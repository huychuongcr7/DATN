<?php
namespace App\Services;

use App\Models\Post;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;

class PostService implements PostServiceInterface
{
    use UploadTrait;

    /**
     * create post
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createPost(array $params)
    {
        \DB::beginTransaction();

        if (!isset($params['post_code'])) {
            $last = Post::orderBy('post_code', 'desc')->first();
            $post_code = $last->post_code;
            $post_code++;
            $params['post_code'] = $post_code;
        }
        if (isset($params['img_url'])) {
            $image = $params['img_url'];
            $name = uniqid();
            $folder = Post::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['img_url'] = $filePath;
        }
        $params['status'] = 1;
        $params['user_id'] = Auth::id();
        Post::create($params);

        \DB::commit();
    }

    /**
     * update post
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updatePost(array $params, int $id)
    {
        \DB::beginTransaction();
        $post = Post::findOrFail($id);

        if (isset($params['img_url'])) {
            $image = $params['img_url'];
            $name = uniqid();
            $folder = Post::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['img_url'] = $filePath;
        }
        $post->update($params);

        \DB::commit();
    }
}
