@extends('layouts.backend.admin')

@section('title', 'Thêm mới khách hàng')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý khách hàng',
            'url' => route('admin.customers.index')
            ],
            [
                'text' => 'Thêm mới khách hàng',
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
                        <form id="validation" method="post" action="{{ route('admin.customers.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.customers.form')
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
            $('#date_of_birth').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });

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
    </script>
@endsection
