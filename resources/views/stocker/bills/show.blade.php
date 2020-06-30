@extends('layouts.backend.admin')

@section('title', 'Thông tin Đơn hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý Đơn hàng',
            'url' => route('stocker.bills.index')
            ],
            [
                'text' => 'Thông tin Đơn hàng',
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
                                    <th width="20%">Mã đơn hàng</th>
                                    <td>{{ $bill->bill_code }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\Bill::$statuses[$bill->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Khách hàng</th>
                                    <td>{{ $bill->customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Phân công cho</th>
                                    <td>@if (isset($bill->user_id)){{ $bill->user->name }} @endif</td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền hàng</th>
                                    <td>{{ App\Helper\Helper::formatMoney($bill->total_money) }} VNĐ</td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            <h3><b>Chi tiết đơn hàng</b></h3>
                            <div class="table-responsive" style="padding-left: 75px; padding-right: 75px">
                                <table id="basic-datatables" class="display table table-striped table-hover dataTable no-footer">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Số tiền</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <a class="text-center my-3" href="{{ route('stocker.products.show', $product['id']) }}">{{ $product['name'] }}</a>
                                            </td>
                                            <td>
                                                @if(isset($product['image_url']))
                                                    <img src="{{ asset($product['image_url']) }}"
                                                         class="img-upload-preview" width="100" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']) }} VNĐ</td>
                                            <td>{{ $product['quantity'] }}</td>
                                            <td>{{ App\Helper\Helper::formatMoney($product['sale_price']*$product['quantity']) }} VNĐ</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('stocker.bills.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    @if($bill->status == \App\Models\Bill::STATUS_DELIVERED)
                                        <a class="btn btn-primary" href="{{ route('stocker.bills.edit', $bill->id) }}">
                                            <span class="btn-label">
                                                <i class="fas fa-edit"></i>
                                            </span>Cập nhật
                                        </a>
                                    @endif
                                    @if($bill->status == \App\Models\Bill::STATUS_ASSIGNED)
                                        <button type="button" data-toggle="modal" data-target="{{ '#exportModal' }}" class="btn btn-success">
                                            <span><i class="fas fa-file-export"></i></span>Xuất hàng
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Modal export -->
                        <div class="modal fade" id="{{ 'exportModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xuất hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn xuất hàng không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form class="form-group" method="POST" action="{{ route('stocker.bills.export', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
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

@endsection
