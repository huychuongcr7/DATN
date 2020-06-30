@extends('layouts.backend.admin')

@section('title', 'Quản lý Đơn hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Quản lý Đơn hàng',
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
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã hóa đơn</th>
                                        <th>Shipper</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bills as $key => $bill)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><a href="{{ route('stocker.bills.show', $bill->id) }}">{{ $bill->bill_code }}</a></td>
                                            <td>@if (isset($bill->user_id)){{ $bill->user->name }} @endif</td>
                                            <td>{{ $bill->customer->name }}</td>
                                            <td>{{ App\Helper\Helper::formatMoney($bill->total_money) }} VNĐ</td>
                                            <td>{{ \App\Models\Bill::$statuses[$bill->status] }}</td>
                                            <td>
                                                @if($bill->status == \App\Models\Bill::STATUS_DELIVERED)
                                                    <div class="form-button-action">
                                                        <a href="{{ route('stocker.bills.edit', $bill->id) }}" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Cập nhật">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                @endif
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
