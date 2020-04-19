@extends('layouts.backend.admin')

@section('title', 'Cập nhật Đơn nhập hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Đơn nhập hàng',
            'url' => route('admin.import_orders.index')
            ],
            [
                'text' => 'Cập nhật Đơn nhập hàng',
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
                        <form method="POST" action="{{ route('admin.import_orders.update', $importOrder->id) }}" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $importOrder->id }}" name="id">
                            @csrf
                            @method('PUT')
                            @include('admin.import_orders.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                callbacks: {
                    onInit: function () {
                        $('#note').val($('#summernote').summernote('code'));
                    },
                    onChange: function (contents) {
                        $('#note').val(contents.replace('&lt;script&gt;', '').replace('&lt;/script&gt;', ''));
                    },
                },
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300
            });
            $('#time_of_import').datetimepicker({
                format: 'YYYY-MM-DD H:mm',
            });
        });
    </script>
@endsection
