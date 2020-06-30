@extends('layouts.backend.admin')

@section('title', 'Thêm mới Tài khoản')

@section('breadcrumb')
    @include('layouts.backend.breadcrumb', [
        'items' => [
            [
                'text' => 'Trang chủ',
                'url' => route('admin.dashboard')
            ],
            [
            'text' => 'Quản lý Tài khoản',
            'url' => route('admin.users.index')
            ],
            [
                'text' => 'Thêm mới Tài khoản',
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
                        <form id="validation" method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.users.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
