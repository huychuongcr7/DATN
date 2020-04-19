@extends('layouts.backend.admin')

@section('title', 'Thông tin Nhà cung cấp')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Nhà cung cấp',
            'url' => route('admin.suppliers.index')
            ],
            [
                'text' => 'Thông tin Nhà cung cấp',
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
                                    <td>{{ $supplier->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã nhà cung cấp</th>
                                    <td>{{ $supplier->supplier_code }}</td>
                                </tr>
                                <tr>
                                    <th>Tên nhà cung cấp</th>
                                    <td>{{ $supplier->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $supplier->email }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>{{ $supplier->address }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>{{ $supplier->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Nợ cần trả</th>
                                    <td>{{ App\Helper\Helper::formatMoney($supplier->supplier_debt) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ \App\Models\Supplier::$statuses[$supplier->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Công ty</th>
                                    <td>{{ $supplier->company }}</td>
                                </tr>
                                <tr>
                                    <th>Mã số thuế</th>
                                    <td>{{ $supplier->tax_code }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $supplier->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $supplier->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $supplier->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-success" href="{{ route('admin.suppliers.edit', $supplier->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#saleModal" class="btn @if ($supplier->status == 1)btn-danger @else btn-primary @endif">
                                        <span class="btn-label">
                                            <i class="fas @if ($supplier->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                        </span>@if ($supplier->status == 1)Ngừng hoạt động @else Hoạt động @endif
                                    </button>
                                    <a class="btn btn-primary" href="{{ route('admin.suppliers.payment', $supplier->id) }}">
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
                                                <div class="modal-body">Bạn có chắc muốn @if ($supplier->status == 1)ngừng hoạt đông @else hoạt động trở lại @endif với nhà cung cấp này không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <form method="POST"
                                                          @if ($supplier->status == 1)action="{{ route('admin.suppliers.stop_suppliers', $supplier->id) }}"
                                                          @else action="{{ route('admin.suppliers.active_suppliers', $supplier->id) }}" @endif>
                                                        @csrf
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
