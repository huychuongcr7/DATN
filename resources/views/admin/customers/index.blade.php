@extends('layouts.backend.admin')

@section('title', 'Quản lý khách hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
                'text' => 'Quản lý khách hàng',
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
                            <h4 class="card-title"><b>@yield('title')</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-round ml-auto mb-3">
                                    <i class="fa fa-plus"></i>
                                    Thêm mới
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Nợ cần thu</th>
                                        <th>Loại khách hàng</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $key => $customer)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}</a></td>
                                            <td>
                                                @if(isset($customer->avatar))
                                                <img src="{{ asset($customer->avatar) }}" class="img-upload-preview" width="100" height="100" alt="preview">
                                                @endif
                                            </td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ App\Helper\Helper::formatMoney($customer->customer_debt) }} VNĐ</td>
                                            <td>{{ \App\Models\Customer::$types[$customer->customer_type] }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Cập nhật">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-toggle="modal" data-target="{{ '#deleteModal' . $key }}" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <button type="button" data-toggle="modal" data-target="{{ '#stopModal' . $key }}" class="btn btn-link @if ($customer->status == 1)btn-danger @else btn-primary @endif">
                                                        <i class="fas @if ($customer->status == 1)fa-lock @else fa-lock-open @endif"></i>
                                                    </button>
                                                    <a href="{{ route('admin.customers.payment', $customer->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Thanh toán">
                                                        <i class="fa fa-credit-card"></i>
                                                    </a>

                                                    <!-- Modal sale -->
                                                    <div class="modal fade" id="{{ 'stopModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn @if ($customer->status == 1)ngừng hoạt động @else hoạt động trở lại @endif với khách hàng này không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                                                    </button>
                                                                    <form method="POST" @if ($customer->status == 1)action="{{ route('admin.customers.stop_customers', $customer->id) }}" @else action="{{ route('admin.customers.active_customers', $customer->id) }}" @endif>
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button class="btn @if ($customer->status == 1)btn-danger @else btn-success @endif" type="submit">Xác nhận</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ 'deleteModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa khách hàng</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn xóa khách hàng không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                    <form method="POST" action="{{ route('admin.customers.destroy', $customer->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger" type="submit">Xóa</button>
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
            $('#basic-datatables').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Vietnamese.json"
                }
            });
        });
    </script>
@endsection
