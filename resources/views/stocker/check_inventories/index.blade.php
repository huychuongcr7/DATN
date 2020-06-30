@extends('layouts.backend.admin')

@section('title', 'Quản lý Kiểm kho')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Quản lý Kiểm kho',
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
                                <a href="{{ route('stocker.check_inventories.create') }}" class="btn btn-primary btn-round ml-auto mb-3">
                                    <i class="fa fa-plus"></i>
                                    Thêm mới
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã kiểm kho</th>
                                        <th>Thời gian kiểm kho</th>
                                        <th>Thời gian cân bằng</th>
                                        <th>Tổng chênh lệch</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($checkInventories as $key => $checkInventory)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a href="{{ route('stocker.check_inventories.show', $checkInventory->id) }}">{{ $checkInventory->check_inventory_code }}</a></td>
                                            <td>{{ $checkInventory->time_check->format('Y-m-d H:i') }}</td>
                                            <td>{{ isset($checkInventory->time_balance) ? $checkInventory->time_balance->format('Y-m-d H:i') : null }}</td>
                                            <td>{{ $checkInventory->total_difference }}</td>
                                            <td>{{ \App\Models\CheckInventory::$statuses[$checkInventory->status] }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    @if($checkInventory->status == \App\Models\CheckInventory::STATUS_TEMPORARY)
                                                        <a href="{{ route('stocker.check_inventories.edit', $checkInventory->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Cập nhật">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    <button type="button" data-toggle="modal" data-target="{{ '#deleteModal' . $key }}" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                        <i class="fa fa-times"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ 'deleteModal' . $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa hóa đơn</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn xóa hóa đơn không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                    <form method="POST" action="{{ route('stocker.check_inventories.destroy', $checkInventory->id) }}">
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
