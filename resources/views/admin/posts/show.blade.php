@extends('layouts.backend.admin')

@section('title', 'Thông tin bài đăng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý bài đăng',
            'url' => route('admin.posts.index')
            ],
            [
                'text' => 'Thông tin bài đăng',
            ],
        ]
    ])
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><b>@yield('title')</b></div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th width="20%">ID</th>
                                    <td>{{ $post->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã bài đăng</th>
                                    <td>{{ $post->post_code }}</td>
                                </tr>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <td>{{ $post->title }}</td>
                                </tr>
                                <tr>
                                    <th>Nội dung</th>
                                    <td>{!! $post->content !!}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{{ $post->description}}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\Post::$statuses[$post->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Tác giả</th>
                                    <td>{{ $post->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $post->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <td>
                                        @if(isset($post->img_url))
                                            <img src="{{ asset('storage'.$post->img_url) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lượt xem</th>
                                    <td>{{ $post->view }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $post->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.posts.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
