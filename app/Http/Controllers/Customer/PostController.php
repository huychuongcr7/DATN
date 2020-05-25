<?php

namespace App\Http\Controllers\Customer;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->post->getPosts($request->all());
        $categories = CategoryPost::pluck('name', 'id');
        return view('customer.posts.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['view' => $post->view + 1]);
        $categories = CategoryPost::pluck('name', 'id');
        return view('customer.posts.show', compact('post', 'categories'));
    }
}
