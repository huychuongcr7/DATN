@extends('layouts.backend.admin')

@section('title', 'Cập nhật sản phẩm')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
            'text' => 'Quản lý sản phẩm',
            'url' => route('stocker.products.index')
            ],
            [
                'text' => 'Cập nhật sản phẩm',
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
                        <form method="POST" action="{{ route('stocker.products.update', $product->id) }}" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            @csrf
                            @method('PUT')
                            @include('stocker.products.form')
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
        });
    </script>
@endsection
