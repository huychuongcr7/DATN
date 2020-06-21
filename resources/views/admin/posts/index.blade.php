@extends('layouts.backend.admin')

@section('title', 'Quản lý bài đăng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
                'text' => 'Quản lý bài đăng',
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
                            <h4 class="card-title"><b>@yield('title')</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-round ml-auto mb-3">
                                    <i class="fa fa-plus"></i>Thêm mới
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="post-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Mã bài đăng</th>
                                        <th>Tiêu đề</th>
                                        <th>Hình ảnh</th>
                                        <th width="15%">Trạng thái</th>
                                        <th>Danh mục</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $key => $post)
                                        <tr>
                                            <td>{{ $post->post_code }}</td>
                                            <td>
                                                <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                                            </td>
                                            <td>
                                                @if(isset($post->img_url))
                                                    <img src="{{ asset($post->img_url) }}" class="img-upload-preview" width="150" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="hidden" value="{{ $post->id }}" id="post_id">
                                                <input type="checkbox" name="status" class="status" @if ($post->status == 1) checked @endif data-toggle="toggle" data-on="Công bố" data-off="Ngừng công bố" data-onstyle="success" data-offstyle="danger" data-style="btn-round">
                                            <td>{{ $post->category->name }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Cập nhật">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-toggle="modal" data-target="{{ '#deleteModal' . $key }}" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                    <!-- Modal delete -->
                                                    <div class="modal fade" id="{{ 'deleteModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa bài đăng</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn xóa bài đăng không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                                                    </button>
                                                                    <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger" type="submit">Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script>
        $(document).ready(function () {
            $('#post-datatables').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Vietnamese.json"
                }
            });

            $('.status').change(function () {
                var post_id = $(this).parent().parent().find('#post_id').val();
                $.ajax({
                    type:'POST',
                    url:'/admin/posts/change_status',
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: { "post_id" : post_id },
                    success: function(data){
                        if(data.data.success){
                            //do something
                        }
                    }
                });
            });
        });
    </script>
@endsection
