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
                                            <img src="{{ asset('storage'.$customer->avatar) }}" class="img-upload-preview" width="100" height="100" alt="preview">
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
                                    <a class="btn btn-success" href="{{ route('admin.customers.edit', $customer->id) }}">
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
