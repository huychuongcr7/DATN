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
            <form id="validation" method="post" action="{{ route('admin.customers.store') }}"
                  enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @include('admin.customers.form')
                </div>
            </form>
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

        // $("#validation").validate({
        //     validClass: "success",
        //     rules: {
        //         // gender: {required: true},
        //         // confirmpassword: {
        //         //     equalTo: "#password"
        //         // },
        //         // date_of_birth: {
        //         //     date: true
        //         // },
        //         // uploadImg: {
        //         //     required: true,
        //         // },
        //     },
        //     highlight: function(element) {
        //         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        //     },
        //     success: function(element) {
        //         $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        //     },
        // });
    </script>
@endsection
