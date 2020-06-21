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
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\Bill::$statuses[$bill->status] }}</td>
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
                                    <th>Tổng tiền hàng</th>
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
                                    <th>Địa chỉ nhận hàng</th>
                                    <td>{{ $bill->address_receive }}</td>
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
                                                <a class="text-center my-3" href="{{ route('admin.products.show', $product['id']) }}">{{ $product['name'] }}</a>
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
                                    <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('admin.bills.edit', $bill->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                    @if($bill->status == 1)
                                        <button type="button" data-toggle="modal" data-target="{{ '#deliveryModal' }}" class="btn btn-warning">
                                            <span><i class="fa fa-car-side"></i></span>Vận chuyển
                                        </button>
                                        <button type="button" data-toggle="modal" data-target="{{ '#cancelModal' }}" class="btn btn-danger">
                                            <span><i class="fa fa-times"></i></span>Hủy bỏ
                                        </button>
                                    @elseif($bill->status == 2)
                                        <button type="button" data-toggle="modal" data-target="{{ '#completeModal' }}" class="btn btn-success">
                                            <span><i class="fa fa-check"></i></span>Hoàn thành
                                        </button>
                                        <button type="button" data-toggle="modal" data-target="{{ '#cancelModal' }}" class="btn btn-danger">
                                            <span><i class="fa fa-times"></i></span>Hủy bỏ
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Modal delivery -->
                        <div class="modal fade" id="{{ 'deliveryModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Vận chuyển đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn vận chuyển đơn hàng không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.delivery', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal complete -->
                        <div class="modal fade" id="{{ 'completeModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hoàn thành đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn hoàn thành đơn hàng không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.complete', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-success" type="submit">Xác nhận</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal cancel -->
                        <div class="modal fade" id="{{ 'cancelModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn hủy đơn hàng không?
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-group" method="POST" action="{{ route('admin.bills.cancel', $bill->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <label>Lý do:</label>
                                            <input type="text" name="reason" class="form-control">
                                            <br>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
