@extends('layouts.backend.admin')

@section('title', 'QUẢN LÝ SẢN PHẨM')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
                'text' => 'Quản lý sản phẩm',
            ],
        ]
    ])
@endsection

@section('alert')
@error('excel_file')
<div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
@enderror
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>@yield('title')</b></h4>
                        </div>
                        <div class="card-body">
                            <div class=row">
                                <div class="col-md-12 text-right">
                                    <button type="button" data-toggle="modal" data-target="#importModal" class="btn btn-primary btn-round ml-auto mb-3">
                                        <i class="fas fa-file-import"></i>Import
                                    </button>
                                    <a class="btn btn-primary btn-round ml-auto mb-3" href="{{ route('admin.products.export') }}">
                                        <i class="fas fa-file-export"></i>Export
                                    </a>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-round ml-auto mb-3">
                                        <i class="fa fa-plus"></i>Thêm mới
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="product-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá bán</th>
                                        <th>Giá vốn</th>
                                        <th>Tồn kho</th>
                                        <th width="15%">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <td>{{ $product->product_code }}</td>
                                            <td>
                                                <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>
                                                @if(isset($product->image_url))
                                                    <img src="{{ asset($product->image_url) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</td>
                                            <td>{{ App\Helper\Helper::formatMoney($product->entry_price) }} VNĐ</td>
                                            <td>{{ $product->inventory }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Cập nhật">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-toggle="modal" data-target="{{ '#deleteModal' . $key }}" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="{{ '#saleModal' . $key }}" class="btn btn-link @if ($product->status == 1)btn-danger @else btn-primary @endif">
                                                        <i class="fas @if ($product->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                                    </button>
                                                    <a href="{{ route('admin.products.export_import', $product->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Lịch sử xuất nhập kho">
                                                        <i class="fa fa-history"></i>
                                                    </a>
                                                    <!-- Modal sale -->
                                                    <div class="modal fade" id="{{ 'saleModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <button class="btn @if ($product->status == 1)btn-danger @else btn-success @endif" type="submit">Xác nhận</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal delete -->
                                                    <div class="modal fade" id="{{ 'deleteModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn xóa sản phẩm không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                                                    </button>
                                                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger" type="submit">Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal import -->
                                                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Import dữ liệu</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="file" name="excel_file" class="form-control">
                                                                        <br>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-success">Import</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script>
        $(document).ready(function () {
            $('#product-datatables').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Vietnamese.json"
                }
            });
        });
    </script>
@endsection
