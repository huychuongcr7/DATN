@extends('layouts.backend.admin')

@section('title', 'Lịch sử xuất nhập kho')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý sản phẩm',
            'url' => route('stocker.products.index')
            ],
            [
                'text' => 'Lịch sử xuất nhập kho',
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
                            <div style="padding-bottom: 20px">
                                <h4><b>Sản phẩm: {{ $product->name }}</b></h4>
                            </div>
                            <div class="table-responsive">
                                <table id="product-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Mã phiếu</th>
                                        <th>Phương thức</th>
                                        <th>Thời gian</th>
                                        <th>Đối tác</th>
                                        <th>Số lượng</th>
                                        <th>Tồn cuối</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exportImports as $key => $exportImport)
                                        @if(isset($exportImport['import_order_code']))
                                            <tr>
                                                <td>
                                                    <a href="{{ route('stocker.import_orders.show', $exportImport['id']) }}">{{ $exportImport['import_order_code'] }}</a>
                                                </td>
                                                <td>Nhập hàng</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $exportImport['time_transaction'])->format('Y-m-d H:i') }}</td>
                                                <td>{{ \App\Models\Supplier::findOrFail($exportImport['supplier_id'])->name }} </td>
                                                <td>{{ $exportImport['quantity'] }} </td>
                                                <td>{{ $exportImport['end_inventory'] }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>
                                                    <a href="{{ route('stocker.bills.show', $exportImport['id']) }}">{{ $exportImport['bill_code'] }}</a>
                                                </td>
                                                <td>Bán hàng</td>
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $exportImport['time_transaction'])->format('Y-m-d H:i') }}</td>
                                                <td>{{ \App\Models\Supplier::findOrFail($exportImport['customer_id'])->name }} </td>
                                                <td>-{{ $exportImport['quantity'] }} </td>
                                                <td>{{ $exportImport['end_inventory'] }}</td>
                                            </tr>
                                        @endif
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
