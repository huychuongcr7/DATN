@extends('layouts.backend.admin')

@section('title', 'Thêm mới Đơn nhập hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý Đơn nhập hàng',
            'url' => route('stocker.import_orders.index')
            ],
            [
                'text' => 'Thêm mới Đơn nhập hàng',
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
                        <form id="validation" method="post" action="{{ route('stocker.import_orders.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('stocker.import_orders.form')
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
