@extends('layouts.backend.admin')

@section('title', 'Thêm mới Danh mục')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Danh mục',
            'url' => route('admin.categories.index')
            ],
            [
                'text' => 'Thêm mới Danh mục',
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
                        <form id="validation" method="post" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.categories.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
