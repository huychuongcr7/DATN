@extends('layouts.backend.admin')

@section('title', 'Thêm mới Nhà cung cấp')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Nhà cung cấp',
            'url' => route('admin.suppliers.index')
            ],
            [
                'text' => 'Thêm mới Nhà cung cấp',
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
                        <form id="validation" method="post" action="{{ route('admin.suppliers.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.suppliers.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
