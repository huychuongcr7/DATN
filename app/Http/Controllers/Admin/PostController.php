<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePostRequest;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Services\PostServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $categories = CategoryPost::pluck('name', 'id');
        $statuses = Post::$statuses;
        return view('admin.posts.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest  $request
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $this->postService->createPost($request->all());
        flash('Thêm mới bài đăng thành công!')->success();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $categories = CategoryPost::pluck('name', 'id');
        $statuses = Post::$statuses;
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(StorePostRequest $request, $id)
    {
        $this->postService->updatePost($request->all(), $id);
        flash('Cập nhật bài đăng thành công!')->success();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        flash('Xóa bài đăng thành công!')->success();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Change status of post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $post = Post::findOrFail($request['post_id']);
        if ($post->status == Post::STATUS_ACTIVE) {
            $post->status = Post::STATUS_STOP;
        } else {
            $post->status = Post::STATUS_ACTIVE;
        }

        return response()->json([
            'data' => [
                'success' => $post->save(),
            ]
        ]);
    }
}
