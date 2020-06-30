@extends('layouts.backend.admin')

@section('title', 'Thông tin Tài khoản')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Tài khoản',
            'url' => route('admin.users.index')
            ],
            [
                'text' => 'Thông tin Tài khoản',
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
                                    <th>ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Avatar</th>
                                    <td>
                                        @if(isset($user->avatar))
                                            <img src="{{ asset($user->avatar) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ \App\Models\User::$statuses[$user->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Vai trò</th>
                                    <td>{{ \App\Models\User::$roles[$user->role] }}</td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td>{{ \App\Models\User::$genders[$user->gender] }}</td>
                                </tr>
                                @if($user->role == \App\Models\User::ROLE_SHIPPER)
                                    <tr>
                                        <th>Đơn hàng đã thực hiện</th>
                                        <td>{{ $user->count_bill }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#saleModal" class="btn @if ($user->status == 1)btn-danger @else btn-primary @endif">
                                        <span class="btn-label">
                                            <i class="fas @if ($user->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                        </span>@if ($user->status == 1)Ngừng hoạt động @else Hoạt động @endif
                                    </button>

                                    <!-- Modal sale -->
                                    <div class="modal fade" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Bạn có chắc muốn @if ($user->status == 1)ngừng hoạt đông @else hoạt động trở lại @endif với tài khoản này không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <form method="POST"
                                                          @if ($user->status == 1)action="{{ route('admin.users.stop_users', $user->id) }}"
                                                          @else action="{{ route('admin.users.active_users', $user->id) }}" @endif>
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-danger" type="submit">Xác nhận</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
