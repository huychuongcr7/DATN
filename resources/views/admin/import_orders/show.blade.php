@extends('layouts.backend.admin')

@section('title', 'Thông tin Đơn nhập hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Đơn nhập hàng',
            'url' => route('admin.import_orders.index')
            ],
            [
                'text' => 'Thông tin Đơn nhập hàng',
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
                                    <td>{{ $importOrder->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã đơn nhập hàng</th>
                                    <td>{{ $importOrder->import_order_code }}</td>
                                </tr>
                                <tr>
                                    <th>Nhà cung cấp</th>
                                    <td>{{ $importOrder->supplier->name }}</td>
                                </tr>
                                <tr>
                                    <th>Người nhập hàng</th>
                                    <td>{{ $importOrder->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Cần trả NCC</th>
                                    <td>{{ App\Helper\Helper::formatMoney($importOrder->total_money) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Đã trả NCC</th>
                                    <td>{{ App\Helper\Helper::formatMoney($importOrder->paid_to_supplier) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Thời gian nhập</th>
                                    <td>{{ $importOrder->time_of_import->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $importOrder->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $importOrder->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $importOrder->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.import_orders.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-success" href="{{ route('admin.import_orders.edit', $importOrder->id) }}">
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
