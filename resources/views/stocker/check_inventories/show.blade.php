@extends('layouts.backend.admin')

@section('title', 'Thông tin Kiểm kho')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý Kiểm kho',
            'url' => route('stocker.check_inventories.index')
            ],
            [
                'text' => 'Thông tin Kiểm kho',
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
                                    <td>{{ $checkInventory->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã kiểm kho</th>
                                    <td>{{ $checkInventory->check_inventory_code }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ App\Models\CheckInventory::$statuses[$checkInventory->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Người kiểm kho</th>
                                    <td>{{ $checkInventory->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Tổng chênh lệch</th>
                                    <td>{{ $checkInventory->total_difference }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian kiểm kho</th>
                                    <td>{{ $checkInventory->time_check->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian cân bằng</th>
                                    <td>{{ isset($checkInventory->time_balance) ? $checkInventory->time_balance->format('Y-m-d H:i') : null }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $checkInventory->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $checkInventory->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $checkInventory->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            <h3><b>Chi tiết kiểm kho</b></h3>
                            <div class="table-responsive" style="padding-left: 75px; padding-right: 75px">
                                <table id="basic-datatables" class="display table table-striped table-hover dataTable no-footer">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Tồn kho</th>
                                        <th>Tồn kho thực tế</th>
                                        <th>Số lượng lệch</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productNews as $productNew)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <a class="text-center my-3" href="{{ route('stocker.products.show', $productNew['id']) }}">{{ $productNew['name'] }}</a>
                                            </td>
                                            <td>
                                                @if(isset($productNew['image_url']))
                                                    <img src="{{ asset($productNew['image_url']) }}"
                                                         class="img-upload-preview" width="100" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>{{ $productNew['inventory_reality'] - $productNew['difference'] }}</td>
                                            <td>{{ $productNew['inventory_reality'] }}</td>
                                            <td>{{ $productNew['difference'] }}</td>
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
                                    @if($checkInventory->status == \App\Models\CheckInventory::STATUS_TEMPORARY)
                                        <a class="btn btn-default" href="{{ route('stocker.check_inventories.index') }}">
                                            <span class="btn-label">
                                                <i class="fa fa-arrow-left"></i>
                                            </span>Quay lại
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('stocker.check_inventories.edit', $checkInventory->id) }}">
                                            <span class="btn-label">
                                                <i class="fas fa-edit"></i>
                                            </span>Cập nhật
                                        </a>
                                        <button type="button" data-toggle="modal" data-target="{{ '#balanceModal' }}" class="btn btn-success">
                                            <span><i class="fas fa-balance-scale"></i></span>Cân bằng kho
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal balance -->
                        <div class="modal fade" id="{{ 'balanceModal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cân bằng kho</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc muốn cân bằng kho không?
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-group" method="POST" action="{{ route('stocker.check_inventories.balance', $checkInventory->id) }}">
                                            @csrf
                                            @method('PUT')
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
