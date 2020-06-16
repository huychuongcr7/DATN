@extends('layouts.backend.admin')

@section('title', 'Thông tin sản phẩm')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý sản phẩm',
            'url' => route('admin.products.index')
            ],
            [
                'text' => 'Thông tin sản phẩm',
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
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <td>
                                        @if(isset($product->image_url))
                                            <img src="{{ asset('storage'.$product->image_url) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Thương hiệu</th>
                                    <td>{{ isset($product->trademark_id) ? $product->trademark->name : null}}</td>
                                </tr>
                                <tr>
                                    <th>Giá bán</th>
                                    <td>{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Giá gốc</th>
                                    <td>{{ App\Helper\Helper::formatMoney($product->entry_price) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Tồn kho</th>
                                    <td>{{ $product->inventory }}</td>
                                </tr>
                                <tr>
                                    <th>Địa điểm đặt</th>
                                    <td>{{ $product->location }}</td>
                                </tr>
                                <tr>
                                    <th>Tồn nhỏ nhất</th>
                                    <td>{{ $product->inventory_level_min }}</td>
                                </tr>
                                <tr>
                                    <th>Tồn lớn nhất</th>
                                    <td>{{ $product->inventory_level_max }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>{{ \App\Models\product::$statuses[$product->status] }}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{!! $product->note !!}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $product->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="form-group row">
                                <label class="col-lg-3"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                                        <span class="btn-label">
                                            <i class="fa fa-arrow-left"></i>
                                        </span>Quay lại
                                    </a>
                                    <a class="btn btn-success" href="{{ route('admin.products.edit', $product->id) }}">
                                        <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                        </span>Cập nhật
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#saleModal" class="btn @if ($product->status == 1)btn-danger @else btn-primary @endif">
                                        <span class="btn-label">
                                            <i class="fas @if ($product->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                        </span>@if ($product->status == 1)Ngừng kinh doanh @else Kinh doanh @endif
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
                                                <div class="modal-body">
                                                    Bạn có chắc muốn @if ($product->status == 1)ngừng kinh doanh @else kinh doanh lại @endif sản phẩm này không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                                    </button>
                                                    <form method="POST" @if ($product->status == 1)action="{{ route('admin.products.stop', $product->id) }}" @else action="{{ route('admin.products.active', $product->id) }}" @endif>
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
