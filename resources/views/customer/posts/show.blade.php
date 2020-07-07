@extends('layouts.frontend.client')
@section('title', 'Thông tin bài đăng')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/grocery.png);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>THÔNG TIN BÀI ĐĂNG</h1>
                </div>
            </div>
        </div>
        <a href="#post_detail" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="post_detail">
        <div class="container">
            <div class="row">
                <div class="col-md-4 sidebar">
                    <div class="sidebar-box">
                        <form action="{{ route('posts.index') }}" class="search-form">
                            <div class="form-group">
                                <span class="icon fa fa-search"></span>
                                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm" value="{{ request('keyword') }}">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box">
                        <div class="categories">
                            <h3>Danh mục</h3>
                            @foreach($categories as $key => $category)
                                <li><a href="{{ route('posts.index') . '?category_id=' . $key }}">{{ $category }}</a></li>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-8 blog-content">
                    <img src="{{ asset($post->img_url) }}" class="img-fluid">
                    <h4 class=" text-black" style="padding-top: 40px"><b>{{ $post->title }}</b></h4>
                    <p>{!! $post->content !!}</p>
                    <div class="pt-5">
                        <p>Danh mục:  <a href="{{ route('posts.index') . '?category_id=' . $post->category_id }}">{{ $post->category->name}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
