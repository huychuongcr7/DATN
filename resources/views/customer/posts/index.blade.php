@extends('layouts.frontend.client')
@section('title', 'Danh sách bài đăng')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay"
         style="background-image: url(/frontend/images/slider-1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>DANH SÁCH BÀI ĐĂNG</h1>
                </div>
            </div>
        </div>
        <a href="#post_list" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="post_list">
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

            @if(!$posts->count())
                <div class="col-md-8">
                    <h5 class="text-center text-danger" style="padding-top: 100px">Không có kết quả tìm kiếm!</h5>
                </div>
                @else
                <div class="col-md-8 blog-content">
                    @foreach($posts as $post)
                        <div class="h-entry" style="padding-bottom: 80px">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <img src="{{ asset($post->img_url) }}" class="img-fluid">
                            </a>
                            <h5 class=" text-black"><b>{{ $post->title }}</b></h5>
                            <div class="meta mb-4">{{ $post->user->name }}
                                <span class="mx-2">&bullet;</span> {{ $post->created_at->format('Y m d') }}
                                <span class="mx-2">&bullet;</span> {{ $post->view }} lượt xem
                                <span class="mx-2">&bullet;</span>
                                <a href="{{ route('posts.show', $post->id) }}">Đọc tiếp <i class="icon-arrow-right"></i></a>
                            </div>
                            <p>{{ substr(strip_tags($post->content), 0, 95)}}{{ strlen(strip_tags($post->content)) > 95 ? '...': ''}}</p>
                        </div>
                    @endforeach
                        <div>{{ $posts->appends(request()->input())->links() }}</div>

                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
