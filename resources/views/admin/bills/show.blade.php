@extends('layouts.backend.admin')

@section('title', 'Thông tin Hóa đơn')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Hóa đơn',
            'url' => route('admin.bills.index')
            ],
            [
                'text' => 'Thông tin Hóa đơn',
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
                                    <td>{{ $bill->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <td>{{ $bill->bill_code }}</td>
                                </tr>
                                <tr>
                                    <th>Khách hàng</th>
                                    <td>{{ $bill->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Người bán hàng</th>
                                    <td>@if (isset($bill->user_id)){{ $bill->user->name }} @endif</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền hang</th>
                                    <td>{{ App\Helper\Helper::formatMoney($bill->total_money) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Khách đã trả</th>
                                    <td>{{ App\Helper\Helper::formatMoney($bill->paid_by_customer) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Thời gian bán</th>
                                    <td>{{ $bill->time_of_sale->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $bill->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $bill->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $bill->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-success" href="{{ route('admin.bills.edit', $bill->id) }}">
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
