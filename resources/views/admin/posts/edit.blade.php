@extends('layouts.backend.admin')

@section('title', 'Cập nhật bài đăng')

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
                'text' => 'Cập nhật bài đăng',
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
                        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $post->id }}" name="id">
                            @csrf
                            @method('PUT')
                            @include('admin.posts.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                callbacks: {
                    onInit: function () {
                        $('#content').val($('#summernote').summernote('code'));
                    },
                    onChange: function (contents) {
                        $('#content').val(contents.replace('&lt;script&gt;', '').replace('&lt;/script&gt;', ''));
                    },
                },
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
