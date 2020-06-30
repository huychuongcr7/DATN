@extends('layouts.backend.admin')

@section('title', 'Thông tin khách hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý khách hàng',
            'url' => route('admin.customers.index')
            ],
            [
                'text' => 'Thông tin khách hàng',
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
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Avatar</th>
                                    <td>
                                        @if(isset($customer->avatar))
                                            <img src="{{ asset($customer->avatar) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh</th>
                                    <td>{{ $customer->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Nợ cần thu</th>
                                    <td>{{ App\Helper\Helper::formatMoney($customer->customer_debt) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ \App\Models\Customer::$statuses[$customer->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Loại khách hàng</th>
                                    <td>{{ \App\Models\Customer::$types[$customer->customer_type] }}</td>
                                </tr>
                                <tr>
                                    <th>Giới tính</th>
                                    <td>{{ \App\Models\Customer::$genders[$customer->gender] }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ facebook</th>
                                    <td>{{ $customer->facebook_url }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $customer->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $customer->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.customers.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('admin.customers.edit', $customer->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#saleModal" class="btn @if ($customer->status == 1)btn-danger @else btn-primary @endif">
                                        <span class="btn-label">
                                            <i class="fas @if ($customer->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                        </span>@if ($customer->status == 1)Ngừng hoạt động @else Hoạt động @endif
                                    </button>
                                    <a class="btn btn-success" href="{{ route('admin.customers.payment', $customer->id) }}">
                                        <span class="btn-label">
                                            <i class="far fa-credit-card"></i>
                                        </span>Thanh toán
                                    </a>

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
                                                <div class="modal-body">Bạn có chắc muốn @if ($customer->status == 1)ngừng hoạt đông @else hoạt động trở lại @endif với khách hàng này không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <form method="POST"
                                                          @if ($customer->status == 1)action="{{ route('admin.customers.stop_customers', $customer->id) }}"
                                                          @else action="{{ route('admin.customers.active_customers', $customer->id) }}" @endif>
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
