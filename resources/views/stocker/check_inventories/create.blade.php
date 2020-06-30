@extends('layouts.backend.admin')

@section('title', 'Thêm mới Kiểm kho')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý Kiểm kho',
            'url' => route('stocker.check_inventories.index')
            ],
            [
                'text' => 'Thêm mới Kiểm kho',
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
                        <form id="validation" method="post" action="{{ route('stocker.check_inventories.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('stocker.check_inventories.form')
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
            $('#time_check').datetimepicker({
                format: 'YYYY-MM-DD H:mm',
            });
        });
    </script>
@endsection
